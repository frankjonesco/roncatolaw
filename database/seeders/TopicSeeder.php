<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $model = new Topic();
        
        $items = $model::on('mysql_import')->get()->toArray();
        foreach($items as $item){
            $model::create($item);
        }
    }
}
