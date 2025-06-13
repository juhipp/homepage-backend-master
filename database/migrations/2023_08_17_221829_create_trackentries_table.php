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
        Schema::create('trackentries', function (Blueprint $table) {
            $table->id();
            $table->string('session');
            $table->timestamp('date');
            $table->string('type');
            $table->string('target')->nullable();
            $table->string('currentUrl');
            $table->boolean('conversion')->default(false);
            $table->text('text')->nullable();
            $table->string('campaign')->nullable();
            $table->string('keyword')->nullable();
            $table->json('params')->nullable();
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
        Schema::dropIfExists('trackentries');
    }
};
