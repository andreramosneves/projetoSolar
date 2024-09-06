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
        Schema::create('project_x_equipament', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('quantity');
            $table->unsignedBigInteger('equipament_id');
            $table->unsignedBigInteger('project_id');
            $table->foreign('equipament_id')->references('id')->on('equipament');
            $table->foreign('project_id')->references('id')->on('project');
            $table->timestamps();
            $table->unique(array('project_id','equipament_id'));

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_x_equipament');
    }
};
