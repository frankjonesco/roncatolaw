<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $model = new Article();
        
        $items = $model::on('mysql_import')->get()->toArray();
        foreach($items as $item){
            $model::create($item);
        }
    }
}
