<?php

use App\Models\BranchLocation;
use App\Models\BranchState;
use App\Models\CallCategory;
use App\Models\User;
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
        Schema::create('call_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class)->nullable();
            $table->foreignIdFor(CallCategory::class)->nullable();
            $table->longText('call_response')->nullable();
            $table->foreignIdFor(User::class,'follow_up_id')->nullable();
            $table->integer('call_duration')->nullable();
            $table->foreignIdFor(BranchLocation::class);
            $table->foreignIdFor(BranchState::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_logs');
    }
};
