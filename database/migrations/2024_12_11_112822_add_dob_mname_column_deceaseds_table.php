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
        Schema::table('deceaseds', function (Blueprint $table) {
            //
            $table->string('date_of_birth')->nullable();
            $table->string('middle_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deceaseds', function (Blueprint $table) {
            //
        });
    }
};
