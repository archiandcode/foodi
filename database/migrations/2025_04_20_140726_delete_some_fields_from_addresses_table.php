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
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('address');
            $table->dropColumn('notes');
            $table->dropColumn('is_default');
            $table->dropForeign('addresses_country_id_foreign');
            $table->dropForeign('addresses_city_id_foreign');

            $table->dropColumn('country_id');
            $table->dropColumn('city_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('label')->nullable();
            $table->string('address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_default')->default(false);
            $table->foreignId('country_id')->constrained();
            $table->foreignId('city_id')->constrained();
        });
    }
};
