<?php

use App\Models\BranchLocation;
use App\Models\BranchState;
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
        Schema::create('service_days', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('service_date')->nullable();
            $table->string('service_day')->nullable();
            $table->integer('no_present')->nullable();
            $table->integer('no_absent')->nullable();
            $table->integer('no_seats')->nullable();
            $table->integer('no_new_comers')->nullable();
            $table->foreignIdFor(BranchLocation::class);
            $table->foreignIdFor(BranchState::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_days');
    }
};
