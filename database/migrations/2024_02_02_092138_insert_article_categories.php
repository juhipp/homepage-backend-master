<?php

use App\Models\ArticleCategory;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  private array $categories = [
    ['title' => 'Nachhaltigkeit', 'name' => 'nachhaltigkeit'],
    ['title' => 'CSRD /ESRS', 'name' => 'csrd_esrs'],
    ['title' => 'Software Updates', 'name' => 'software_updates'],
    ['title' => 'Unternehmens News', 'name' => 'unternehmen_news']
  ];

  public function up(): void
  {
    foreach($this->categories as $category){
      ArticleCategory::create($category);
    }
  }
};
