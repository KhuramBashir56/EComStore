<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 48);
            $table->string('slug', 48);
            $table->string('description', 255);
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 48);
            $table->string('slug', 48);
            $table->string('description', 255);
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 20)->unique();
            $table->string('name', 48);
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email', 64)->unique();
            $table->string('phone', 64)->unique();
            $table->string('password', 255);
            $table->string('profile_image', 255)->nullable();
            $table->enum('status', ['active', 'blocked', 'deleted'])->default('active');
            $table->timestamps(6);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
        });

        Schema::create('account_status_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['active', 'blocked', 'delete']);
            $table->string('status_message', 255);
            $table->foreignId('action_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps(6);
        });

        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 20)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type', ['home', 'office', 'shop', 'store']);
            $table->string('name', 48);
            $table->string('email', 64)->nullable();
            $table->string('phone', 15);
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('state_id')->constrained('states')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('address', 255);
            $table->string('postal_code', 6)->nullable();
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->timestamps(6);
        });

        Schema::create('news_letter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 20)->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email', 48);
            $table->enum('status', ['verified', 'unverified'])->default('unverified');
            $table->timestamps(6);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
        Schema::dropIfExists('account_status_remarks');
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('news_letter_subscribers');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
