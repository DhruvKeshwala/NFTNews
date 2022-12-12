<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) { 
	    	News::create([
                'categoryId' => 1,
                'authorId' => 1,
                'title' => Str::random(10),
                'shortDescription' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae expedita nisi omnis laboriosam temporibus! Asperiores, hic possimus natus nesciunt veniam tenetur.',
                'fullDescription' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae expedita nisi omnis laboriosam temporibus! Asperiores, hic possimus natus nesciunt veniam tenetur.',
                'image' => '',
                'article_1' => '',
                'article_2' => '',
                'videoURL' => 'http://localhost/NFTNews/public/add_news',
                'newsType' => '{"homeheader":{"start_date":"06-12-2022","end_date":"07-12-2022"},"featurednew":{"start_date":"08-12-2022","end_date":"16-12-2022"},"featureddrop":{"start_date":"","end_date":""},"homenews":{"start_date":"","end_date":""}}',
                'fld_status' => 'Active',
            ]);
    	}
    }
}
