<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_plans', function (Blueprint $table) {
            $table->renameColumn('total_amount', 'total_earning');
        });
    }
    
    public function down()
    {
        Schema::table('user_plans', function (Blueprint $table) {
            $table->renameColumn('total_earning', 'total_amount');
        });
    }
    
};
