<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDtlCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtl_cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cotizacion');
            $table->integer('repuesto');
            $table->integer('user');
            $table->integer('cantidad');
            $table->decimal('monto',18,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dtl_cotizacions');
    }
}
