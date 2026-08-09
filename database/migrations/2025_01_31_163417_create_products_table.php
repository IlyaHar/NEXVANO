<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('products', function (Blueprint $table) { $table->id(); $table->string('slug')->unique(); $table->string('title_uk'); $table->string('title_es'); $table->string('subtitle_uk')->nullable(); $table->string('subtitle_es')->nullable(); $table->text('description_uk'); $table->text('description_es'); $table->text('benefits_uk')->nullable(); $table->text('benefits_es')->nullable(); $table->text('composition_uk')->nullable(); $table->text('composition_es')->nullable(); $table->text('application_uk')->nullable(); $table->text('application_es')->nullable(); $table->string('image')->nullable(); $table->string('volume')->default('5 L'); $table->boolean('featured')->default(false); $table->boolean('is_active')->default(true); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('products'); }
};
