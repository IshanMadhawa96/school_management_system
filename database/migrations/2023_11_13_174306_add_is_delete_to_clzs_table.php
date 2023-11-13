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
        Schema::table('clzs', function (Blueprint $table) {
            $table->boolean('is_delete')->default(false)->after('created_by')->comment('0:no, 1:yes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clzs', function (Blueprint $table) {
            Schema::table('clzs', function (Blueprint $table) {
                $table->dropColumn('is_delete');
            });
        });
    }
};
