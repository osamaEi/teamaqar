<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'city')) {
                $table->string('city')->nullable()->after('location');
            }
            if (!Schema::hasColumn('properties', 'address')) {
                $table->string('address')->nullable()->after('city');
            }
            if (!Schema::hasColumn('properties', 'price_per_meter')) {
                $table->decimal('price_per_meter', 15, 2)->nullable()->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(array_filter(['city', 'address', 'price_per_meter'], function ($col) {
                return Schema::hasColumn('properties', $col);
            }));
        });
    }
};
