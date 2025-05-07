<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanIdAndAmountToUserTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('user_transactions', function (Blueprint $table) {
            // Add the new columns
            $table->unsignedBigInteger('plan_id')->nullable(); // safest option
            $table->decimal('amount', 10, 2)->nullable()->after('plan_id');
        });
    }

    public function down()
    {
        Schema::table('user_transactions', function (Blueprint $table) {
            // Remove the columns if rolling back
            $table->dropColumn('plan_id');
            $table->dropColumn('amount');
        });
    }
}
