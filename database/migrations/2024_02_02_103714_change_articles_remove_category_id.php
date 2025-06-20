<?php

use App\Models\Article;
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
      Schema::table('articles', function(Blueprint $table){
        $table->dropForeign('articles_category_id_foreign');
        $table->dropColumn('category_id');
      });
    }

};
