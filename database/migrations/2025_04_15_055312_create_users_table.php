<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('city');
            $table->string('referral_code')->unique();
            $table->unsignedBigInteger('referrer_id')->nullable();
            $table->decimal('main_wallet', 10, 2)->default(0);
            $table->decimal('referral_wallet', 10, 2)->default(0);
            $table->decimal('withdrawal_amount', 10, 2)->default(0); // 🆕 New column
            $table->integer('total_referred_users')->default(0);
            $table->timestamps();
    
            $table->foreign('referrer_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

