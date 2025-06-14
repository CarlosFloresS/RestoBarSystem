<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->index();
            $table->foreignId('menu_entry_id');
            $table->integer('quantity');
            $table->string('notes');
            $table->string('status');
            $table->timestamps();

            $table->foreign('table_id')
                ->references('id')
                ->on('tables')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('menu_entry_id')
                ->references('id')
                ->on('menu_entries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
