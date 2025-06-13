<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('permapath')->nullable()->unique();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('permapath')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('permapath');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('permapath');
        });
    }
};
