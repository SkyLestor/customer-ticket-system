<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique()->after('id');
            $table->string('title');
            $table->text('description');
            $table->string('priority')->default('low'); // low, medium, high TicketPriority enum
            $table->string('status')->default('open');   // open, closed, uses TicketStatus enum
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
