<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePlanIdNullableInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_id')->nullable()->change();
        });
    }
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Only make NOT NULL if you're 100% sure all rows have values
            // Otherwise, either delete this or ensure data is fixed before reverting
            // $table->unsignedBigInteger('plan_id')->nullable(false)->change();
        });
    }
}    