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
        // Schema::create('outreaches', function (Blueprint $table) {
        //     // $table->id();
        //     // $table->timestamps();
        //     // $table->foreignIdFor(OutreachLog::class);
        //     // $table->string('name')->nullable();
        //     // $table->string('phone')->nullable();
        //     // $table->foreignIdFor(OutreachLocation::class)->nullable();
        //     // $table->boolean('is_coming')->nullable();
        //     // $table->timestamp('date')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outreaches');
    }
};
