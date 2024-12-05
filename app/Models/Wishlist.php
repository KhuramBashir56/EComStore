<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Wishlist extends Model
{
    protected $table = 'wishlist_items';

    protected $fillable = ['user_id', 'product_id'];

    protected $guarded = ['id', 'status', 'created_at', 'updated_at'];

    public static function addToWishlist($product_id)
    {
        if (count(Auth::user()->wishlist->where('status', 'active')) < 25) {
            $exist_in = self::where('status', 'active')->where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();
            if (empty($exist_in)) {
                try {
                    DB::transaction(function () use ($product_id) {
                        self::create([
                            'user_id' => Auth::user()->id,
                            'product_id' => $product_id
                        ]);
                        ActivityLog::activity($product_id, 'create', 'Wishlist', NULL);
                    });
                    return ['status' => 'success', 'message' => 'Product added to wishlist successfully.'];
                } catch (\Throwable $th) {
                    return ['status' => 'error', 'message' => 'Something went wrong please try again.'];
                }
            } else {
                return ['status' => 'warning', 'message' => 'Product already added to wishlist.'];
            }
        } else {
            return ['status' => 'warning', 'message' => 'You are reaching the limit of 25 items in your wishlist.'];
        }
    }
}
