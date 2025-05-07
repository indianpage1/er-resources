<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key for the transaction
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->string('user_name'); // User name
            $table->string('payment_screenshot'); // Path to the payment screenshot
            $table->string('plan_Name'); // Plan number (1, 2, etc.)
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Add the status column
            $table->timestamps(); // Created at and updated at timestamps

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
}
