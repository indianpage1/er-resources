<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardStatsTable extends Migration
{
    public function up()
    {
        Schema::create('dashboard_data', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_withdrawals', 15, 2)->default(0);
            $table->decimal('total_investment', 15, 2)->default(0);
            $table->integer('total_users')->default(0);
            $table->integer('referral_users')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dashboard_data');
    }
}
