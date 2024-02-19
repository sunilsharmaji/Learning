<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        \DB::statement("
            CREATE TABLE events (
               
                name varchar(10),
                user_id varchar(10),
                activity_id varchar(20),
                timestamp datetime
            );
        ");
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::statement("
            Drop TABLE events;
        ");
    }
};
