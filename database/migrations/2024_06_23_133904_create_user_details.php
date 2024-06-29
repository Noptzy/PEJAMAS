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
        Schema::create('user_details', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('identity_image')->nullable();
            $table->string('identity')->nullable();
            $table->longtext('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('state')->nullable();
            $table->string('phone')->nullable();
            $table->enum('gender',['L','P'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
