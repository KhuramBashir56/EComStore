<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'cart_items';

    protected $fillable = ['user_id', 'product_id'];

    protected $guarded = ['id', 'status', 'created_at', 'updated_at'];

    public static function addToCart($product_id) {
        if (count(Auth::user()->cart->where('status', 'active')) < 15) {
            $exist_in = self::where('status', 'active')->where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
            if (empty($exist_in)) {
                try {
                    DB::transaction(function () use ($product_id) {
                        self::create([
                            'user_id' => Auth::user()->id,
                            'product_id' => $product_id
                        ]);
                        ActivityLog::activity($product_id, 'create', 'Cart', NULL);
                    });
                    return ['status' => 'success', 'message' => 'Product added to cart successfully.'];
                } catch (\Throwable $th) {
                    return ['status' => 'error', 'message' => 'Something went wrong please try again.'];
                }
            } else {
                return ['status' => 'warning', 'message' => 'Product already added to cart.'];
            }
        } else {
            return ['status' => 'warning', 'message' => 'You are reaching the limit of 15 items in your cart.'];
        }
    }
}
