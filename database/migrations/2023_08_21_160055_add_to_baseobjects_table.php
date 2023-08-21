<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_objects', function (Blueprint $table) {
            $table->boolean('free')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('android')->default(false);
            $table->boolean('ios')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_objects', function (Blueprint $table) {
            $table->dropColumn('free');
            $table->dropColumn('paid');
            $table->dropColumn('android');
            $table->dropColumn('ios');
        });
    }
};
