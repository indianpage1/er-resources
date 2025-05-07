<?php

// database/migrations/xxxx_xx_xx_create_savewithdrawlaccount_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateWithdrawalAccountsTable extends Migration

{
    public function up()
    {
        Schema::create('savewithdrawlaccount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('account_holder_name');
            $table->string('mobile_number');
            $table->string('method'); // e.g., JazzCash, EasyPaisa
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('savewithdrawlaccount');
    }
}
