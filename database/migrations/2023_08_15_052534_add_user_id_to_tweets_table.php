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
        Schema::table('tweets', function (Blueprint $table) {
            // 🔽 1行追加
          $table->foreignId('user_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        SSchema::table('tweets', function (Blueprint $table) {
    // 🔽 2行追加
    $table->dropForeign(['user_id']);
    $table->dropColumn(['user_id']);
  });
    }
};
