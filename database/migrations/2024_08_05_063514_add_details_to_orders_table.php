<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('merek_motor');
            $table->string('seri_motor');
            $table->string('mesin_motor');
            $table->string('no_plat');
            $table->string('jenis_servis');
            $table->date('tanggal_booking');
            $table->boolean('is_paid')->default(false);
            $table->string('payment_proof')->nullable();
            $table->string('status_servis')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'merek_motor',
                'seri_motor',
                'mesin_motor',
                'no_plat',
                'jenis_servis',
                'tanggal_booking',
                'is_paid',
                'payment_proof',
                'status_servis',
            ]);
        });
    }
}
