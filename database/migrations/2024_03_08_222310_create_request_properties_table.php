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
        Schema::create('request_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_type')->nullable();
            $table->string('request_name')->nullable();
            $table->timestamp('contact_datetime')->nullable();
            $table->string('client_phone')->nullable();
            $table->enum('traking_client', [
                'لم يتم البدء فى الاجراءات', 
                'الاتصال بالعميل', 
                'جاري توفير عروض له', 
                'تم ارسال العروض له', 
                'تحديد موعد لمشاهده العروض', 
                'دفع عربون وحجز العرض', 
                'اغلاق طلب العميل'
            ])->default('لم يتم البدء فى الاجراءات')->charset('utf8')->collation('utf8_unicode_ci');
            $table->boolean('read')->default(false);            
                    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_properties');
    }
};
