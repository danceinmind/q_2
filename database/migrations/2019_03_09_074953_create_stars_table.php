<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stars', function (Blueprint $table) {
            // $table->increments('id');
            $table->date('date');
            $table->char('starName');
            $table->primary(['date', 'starName']);
            $table->text('overview');
            $table->text('overview_description');
            $table->text('love');
            $table->text('love_description');
            $table->text('career');
            $table->text('career_description');
            $table->text('financial');
            $table->text('financial_description');
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
        Schema::dropIfExists('stars');
    }
}
