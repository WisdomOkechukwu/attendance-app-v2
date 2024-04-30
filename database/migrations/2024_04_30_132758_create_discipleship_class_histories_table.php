<?php

use App\Models\DiscipleshipClass;
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
        Schema::create('discipleship_class_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(DiscipleshipClass::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipleship_class_histories');
    }
};
