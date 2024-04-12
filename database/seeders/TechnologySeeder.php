<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technology_data = [


            'HTML5',
            'CSS3',
            'GIT',
            'JAVASCRIPT ES5',
            'FAKER',
            'BOOTSTRAP',
            'AXIOS',
            'VUE',
            'SQL',
            'PHP',
            'API',
            'JSON',
            'LARAVEL',
            'BLADE',
            'ELOQUENT',
        ];


        foreach ($technology_data as $_technology) {
            $technology = new Technology;
            $technology->label = $_technology;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
