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
        Schema::table('study', function (Blueprint $table) {
            $table->integer('conaudio')->default(0)->after('fechaestudio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('study', function (Blueprint $table) {
            $table->dropColumn('conaudio');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
