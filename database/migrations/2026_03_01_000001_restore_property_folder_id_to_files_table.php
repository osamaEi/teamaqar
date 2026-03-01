<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            if (!Schema::hasColumn('files', 'property_id')) {
                $table->unsignedBigInteger('property_id')->nullable()->after('id');
                $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            }

            if (!Schema::hasColumn('files', 'folder_id')) {
                $table->unsignedBigInteger('folder_id')->nullable()->index()->after('property_id');
                $table->foreign('folder_id')->references('id')->on('folders')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            if (Schema::hasColumn('files', 'folder_id')) {
                $table->dropForeign(['folder_id']);
                $table->dropColumn('folder_id');
            }
            if (Schema::hasColumn('files', 'property_id')) {
                $table->dropForeign(['property_id']);
                $table->dropColumn('property_id');
            }
        });
    }
};
