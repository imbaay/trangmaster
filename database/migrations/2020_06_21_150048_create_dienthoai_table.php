<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDienthoaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dienthoai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('noisanxuat_id')->unsigned()->index();
            $table->integer('danhmuc_id')->unsigned()->index();
            $table->integer('image_id')->unsigned()->index();
            $table->bigInteger('quantity');
            $table->bigInteger('init_price');
            $table->integer('discount_rate')->nullable();
            $table->double('price');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('noisanxuat_id')->references('id')->on('noisanxuat')->onDelete('cascade');
            $table->foreign('danhmuc_id')->references('id')->on('danhmuc')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dienthoai');
    }
}
