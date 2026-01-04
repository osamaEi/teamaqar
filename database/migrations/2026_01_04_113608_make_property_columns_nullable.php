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
            $table->string('land_situation')->nullable()->change();
            $table->string('property_type')->nullable()->change();
            $table->string('propery_cat')->nullable()->change();
            $table->string('owner_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('land_situation')->nullable(false)->change();
            $table->string('property_type')->nullable(false)->change();
            $table->string('propery_cat')->nullable(false)->change();
            $table->string('owner_status')->nullable(false)->change();
        });
    }
};
