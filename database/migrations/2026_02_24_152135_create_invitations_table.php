<?php

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
        Schema::create('invitations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('from_user')->constrained('users')->onDelete('cascade');
        $table->foreignId('to_user')->constrained('users')->onDelete('cascade');
        $table->foreignId('colocation_id')->constrained()->onDelete('cascade');
        $table->string('status')->default('waiting');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
