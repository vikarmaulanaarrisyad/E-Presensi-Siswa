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
        Schema::table('classes', function (Blueprint $table) {
            $table->string('class_rombel')->after('class_name');
            $table->unsignedBigInteger('academic_id')->after('class_rombel');

            $table->foreign('academic_id')
                ->references('id')
                ->on('academic_years')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('class_rombel');
            $table->dropForeign('classes_academic_id_foreign');
        });
    }
};
