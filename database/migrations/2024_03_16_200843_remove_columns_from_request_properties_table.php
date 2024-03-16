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
        Schema::table('request_properties', function (Blueprint $table) {
            
            $table->dropColumn('contact_datetime');
            $table->dropColumn('read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_properties', function (Blueprint $table) {
            
            $table->timestamp('contact_datetime')->nullable();
            $table->boolean('read')->default(false);
        });
    }
};
