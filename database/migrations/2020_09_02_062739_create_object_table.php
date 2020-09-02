<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flowchart_id')
                    ->constrained('flowchart')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('parent')->nullable();
            $table->integer('action_type')->nullable();
            $table->string('action')->nullable();
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
        Schema::dropIfExists('object');
    }
}
