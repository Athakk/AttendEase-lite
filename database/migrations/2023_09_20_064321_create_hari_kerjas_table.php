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
        Schema::create('hari_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('nm_harikerja');
            $table->boolean('senin')->default(false);
            $table->boolean('selasa')->default(false);
            $table->boolean('rabu')->default(false);
            $table->boolean('kamis')->default(false);
            $table->boolean('jumat')->default(false);
            $table->boolean("sabtu")->default(false);
            $table->boolean("minggu")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hari_kerjas');
    }
};
