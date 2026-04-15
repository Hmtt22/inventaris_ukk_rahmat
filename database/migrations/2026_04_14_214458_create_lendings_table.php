<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                ->constrained('items')
                ->onDelete('cascade');

            // nama peminjam (manual input)
            $table->string('name');

            $table->integer('total');

            $table->text('description')->nullable();

            // siapa yang input
            $table->string('edited_by');

            // status return
            $table->boolean('is_returned')->default(false);

            // waktu return
            $table->timestamp('returned_at')->nullable();

            // ini otomatis: created_at = tanggal pinjam
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};