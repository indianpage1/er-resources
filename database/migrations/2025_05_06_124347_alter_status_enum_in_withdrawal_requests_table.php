<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterStatusEnumInWithdrawalRequestsTable extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE withdrawal_requests 
            MODIFY status ENUM('pending', 'approved', 'rejected', 'delivered') 
            NOT NULL DEFAULT 'pending'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE withdrawal_requests 
            MODIFY status ENUM('pending', 'rejected', 'delivered') 
            NOT NULL DEFAULT 'pending'");
    }
}

