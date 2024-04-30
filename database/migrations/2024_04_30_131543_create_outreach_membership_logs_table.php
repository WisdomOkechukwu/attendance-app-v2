<?php

use App\Models\Outreach;
use App\Models\OutreachLog;
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
        Schema::create('outreach_membership_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(OutreachLog::class);
            $table->foreignIdFor(Outreach::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outreach_membership_logs');
    }
};
