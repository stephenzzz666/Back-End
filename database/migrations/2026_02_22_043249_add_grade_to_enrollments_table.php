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
    Schema::table('enrollments', function (Blueprint $table) {
        $table->string('grade')->nullable(); // e.g., A, B, C
        $table->decimal('score', 5, 2)->nullable(); // optional numeric score
    });
}

public function down(): void
{
    Schema::table('enrollments', function (Blueprint $table) {
        $table->dropColumn(['grade','score']);
    });
}
};
