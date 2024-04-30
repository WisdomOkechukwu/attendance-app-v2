<?php

use App\Models\TextMessageGroup;
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
        Schema::create('text_message_group_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(TextMessageGroup::class);
            $table->foreignIdFor(User::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('text_message_group_members');
    }
};
