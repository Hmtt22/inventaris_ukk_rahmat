<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lendings', function (Blueprint $table) {

            // contoh: kalau sebelumnya ada kolom date → hapus
            if (Schema::hasColumn('lendings', 'date')) {
                $table->dropColumn('date');
            }

            // tambah returned_at kalau belum ada
            if (!Schema::hasColumn('lendings', 'returned_at')) {
                $table->timestamp('returned_at')->nullable();
            }

            // kalau edited_by belum ada
            if (!Schema::hasColumn('lendings', 'edited_by')) {
                $table->string('edited_by')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('lendings', function (Blueprint $table) {

            // rollback (optional)
            $table->date('date')->nullable();
            $table->dropColumn('returned_at');
            $table->dropColumn('edited_by');

        });
    }
};