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
        Schema::create('member_call_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(User::class)->nullable();
            $table->boolean('is_called')->default(0)->nullable();
            $table->string('type')->nullable();
            $table->foreignIdFor(BranchLocation::class);
            $table->foreignIdFor(BranchState::class);
            $table->foreignIdFor(User::class,'follow_up_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_call_logs');
    }
};
