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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->float('montant');
            $table->date('date');
            $table->enum('status',['payed','notpayed'])->default('notpayed');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('colocation_id')->constrained();
            $table->integer('payer');
            $table->foreign('payer')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
