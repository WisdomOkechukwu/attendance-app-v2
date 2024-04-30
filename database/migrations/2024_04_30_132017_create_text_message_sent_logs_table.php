<?php

use App\Models\TextMessageGroup;
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
        Schema::create('text_message_sent_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(TextMessageGroup::class);
            $table->longText('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_message_sent_logs');
    }
};
