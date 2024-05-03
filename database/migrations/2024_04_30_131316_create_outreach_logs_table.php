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
        // Schema::create('outreach_logs', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->timestamps();
        //     // $table->foreignIdFor(OutreachLocation::class)->nullable();
        //     // $table->integer('no_soul_won')->nullable();
        //     // $table->integer('no_coming')->nullable();
        //     // $table->timestamp('date')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outreach_logs');
    }
};
