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
            $table->string('plan_name'); // Adding the plan_name column
            $table->decimal('total_amount', 10, 2); // Adding the total_amount column
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('user_plans', function (Blueprint $table) {
            $table->dropColumn(['plan_name', 'total_amount']);
        });
    }
        
};
