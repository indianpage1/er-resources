<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAmountToPlanAmountInUserTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('user_transactions', function (Blueprint $table) {
            $table->renameColumn('amount', 'plan_amount');
        });
    }

    public function down()
    {
        Schema::table('user_transactions', function (Blueprint $table) {
            $table->renameColumn('plan_amount', 'amount');
        });
    }
}
