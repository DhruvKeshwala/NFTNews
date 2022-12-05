<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) { 
	    	Category::create([
                'name' => Str::random(10),
                'slug' => Str::random(5),
                'title' => Str::random(10),
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae expedita nisi omnis laboriosam temporibus! Asperiores, hic possimus natus nesciunt veniam tenetur.',
                'keywords' => Str::random(20),
            ]);
    	}
    }
}
