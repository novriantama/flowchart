<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowchartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flowchart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
                    ->constrained('flowchart_type')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('chart_name');
            $table->string('flowline_name')
                    ->nullable();
            $table->integer('previous_chart')
                    ->nullable();
            $table->integer('action_type')
                    ->nullable();
            $table->string('action')
                    ->nullable();
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
        Schema::dropIfExists('flowchart');
    }
}
