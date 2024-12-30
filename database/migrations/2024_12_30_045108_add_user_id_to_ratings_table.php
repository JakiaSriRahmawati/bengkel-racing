<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('ratings', function (Blueprint $table) {
        if (!Schema::hasColumn('ratings', 'user_id')) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        }
    });
}

    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
