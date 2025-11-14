<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('aadhar', 20)->nullable();
            $table->string('trainer_id', 30);
            $table->string('qp_code', 30)->nullable();
            $table->string('grade', 10)->nullable();
            $table->date('issue_date')->nullable();
            $table->string('qr_ref', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};


