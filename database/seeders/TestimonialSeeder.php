<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $model = new Testimonial();
        
        $items = $model::on('mysql_import')->get()->toArray();
        foreach($items as $item){
            $model::create($item);
        }
    }
}
