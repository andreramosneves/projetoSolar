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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('type_installation_id');
            $table->unsignedBigInteger('uf_id');
            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('type_installation_id')->references('id')->on('type_installation');
            $table->foreign('uf_id')->references('id')->on('uf');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
