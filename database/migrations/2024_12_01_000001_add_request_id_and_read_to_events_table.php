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
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'request_id')) {
                $table->unsignedBigInteger('request_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('events', 'read')) {
                $table->boolean('read')->default(false)->after('textColor');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'request_id')) {
                $table->dropColumn('request_id');
            }
            if (Schema::hasColumn('events', 'read')) {
                $table->dropColumn('read');
            }
        });
    }
};
