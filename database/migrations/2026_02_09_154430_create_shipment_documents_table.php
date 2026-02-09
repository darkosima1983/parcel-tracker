<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('shipment_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')
                ->constrained('shipment') // tvoja tabela je singular
                ->cascadeOnDelete();

            $table->string('original_name');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type');
            $table->string('file_type'); // pdf / document / image
            $table->unsignedBigInteger('size');

            $table->timestamps();
        });
    }




   
    public function down(): void
    {
        Schema::dropIfExists('shipment_documents');
    }
};
