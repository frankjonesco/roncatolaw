<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $model = new User();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'id' => $item->id,
                'hex' => $item->hex,
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'email_verified_at' => $item->email_verified_at,
                'password' => $item->password,
                'remember_token' => $item->remember_token,
                'image' => $item->image,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ]);
        }
    }
}
