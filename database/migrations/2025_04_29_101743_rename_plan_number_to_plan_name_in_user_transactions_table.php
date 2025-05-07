<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePlanNumberToPlanNameInUserTransactionsTable extends Migration
{
    public function up()
    {
        // No need to rename anything if 'plan_number' doesn't exist
        // You can leave this empty or add other necessary operations like adding new columns.
    }

    public function down()
    {
        // You can leave this empty as well since the column doesn't exist
    }
}

