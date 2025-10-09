<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('threats', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('DoS');
            $table->string('severity')->default('medium');
            $table->string('status')->default('active'); // active | reviewed | resolved
            $table->string('source_ip')->nullable();
            $table->timestamp('detected_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('threats');
    }
};