<?php

use App\Models\Quack;
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
        Schema::create('requacks', function (Blueprint $table) {
        $table->foreignIdFor(User::class)->constrained();
        $table->foreignIdFor(Quack::class)->constrained();
        $table->primary(['user_id', 'quack_id']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requacks');
    }
};
