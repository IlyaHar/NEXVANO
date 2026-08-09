<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('categories', function (Blueprint $table) { $table->id(); $table->string('slug')->unique(); $table->string('name_uk'); $table->string('name_es'); $table->text('description_uk')->nullable(); $table->text('description_es')->nullable(); $table->string('icon')->default('leaf'); $table->unsignedInteger('sort_order')->default(0); $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('categories'); }
};
