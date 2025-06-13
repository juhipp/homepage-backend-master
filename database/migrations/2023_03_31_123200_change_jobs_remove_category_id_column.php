<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
          Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign('jobs_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }

};
