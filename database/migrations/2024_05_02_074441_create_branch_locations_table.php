<?php

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
        Schema::create('branch_locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('branch_name')->nullable();
            $table->foreignIdFor(BranchState::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_locations');
    }
};
