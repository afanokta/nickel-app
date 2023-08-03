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
        Schema::create('transport_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('agree_id')->nullable();
            $table->boolean('is_agree')->nullable();
            $table->boolean('is_complete')->default(false);
            $table->string('need');
            $table->string('driver')->nullable();
            $table->dateTime('booking_date');
            $table->integer('gas');
            $table->enum('status', ['disetujui', 'tidak_disetujui', 'menunggu_persetujuan', 'diproses']);
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('agree_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_usages');
    }
};
