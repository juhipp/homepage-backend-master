<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->tinyInteger('active')->default(0);
            $table->softDeletes();

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();

            $table->foreignId('content_id');
            $table->foreign('content_id')->references('id')->on('contents')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
