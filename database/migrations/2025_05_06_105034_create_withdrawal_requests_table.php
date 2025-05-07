<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->decimal('withdrawal_amount', 15, 2);
            $table->string('account_name');
            $table->string('account_number');
            $table->string('payment_method');
            $table->enum('status', ['delivered', 'pending', 'rejected'])->default('pending');
            $table->decimal('user_main_wallet', 15, 2)->default(0.00);
            $table->timestamps();

            // Foreign keys (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('plan_id')->references('id')->on('plans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawal_requests');
    }
}
