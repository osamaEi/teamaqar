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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('mediator1')->nullable();
            $table->string('phone1')->nullable();
            $table->string('mediator2')->nullable();
            $table->string('phone2')->nullable();
            $table->string('owner')->nullable();
            $table->string('owner_status')->nullable();
            $table->string('ophone')->nullable();
            $table->string('notes')->nullable();
            $table->string('propery_cat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
        });
    }
};
