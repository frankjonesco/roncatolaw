<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = new Message();
        
        $items = $model::on('mysql_import')->get()->toArray();
        foreach($items as $item){
            $model::create($item);
        }
    }
}
