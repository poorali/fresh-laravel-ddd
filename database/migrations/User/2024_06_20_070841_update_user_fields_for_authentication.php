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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->string( 'firstname');
            $table->string( 'lastname')->nullable();
            $table->string( 'gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('timezone')->default('UTC');
            $table->text('summary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn( 'firstname');
            $table->dropColumn( 'lastname');
            $table->dropColumn( 'gender');
            $table->dropColumn('avatar');
            $table->dropColumn('timezone');
            $table->dropColumn('summary');
        });
    }
};
