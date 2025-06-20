<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('workplace')->nullable();
            $table->string('worktime')->nullable();
        });
    }
};
