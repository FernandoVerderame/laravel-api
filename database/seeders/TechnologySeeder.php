<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            ['label' => 'HTML', 'color' => '#E44D26', 'icon' => 'fa-brands fa-html5'],
            ['label' => 'CSS', 'color' => '#264DE4', 'icon' => 'fa-brands fa-css3-alt'],
            ['label' => 'Bootstrap', 'color' => '#8211FA', 'icon' => 'fa-brands fa-bootstrap'],
            ['label' => 'Vue', 'color' => '#41B883', 'icon' => 'fa-brands fa-vuejs'],
            ['label' => 'PHP', 'color' => '#777BB3', 'icon' => 'fa-brands fa-php'],
            ['label' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'fa-brands fa-laravel'],
            ['label' => 'SASS', 'color' => '#CD6799', 'icon' => 'fa-brands fa-sass'],
            ['label' => 'JavaScript', 'color' => '#EFD81D', 'icon' => 'fa-brands fa-js']
        ];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();

            $new_technology->label = $technology['label'];
            $new_technology->slug = Str::slug($new_technology->label);
            $new_technology->color = $technology['color'];
            $new_technology->icon = $technology['icon'];

            $new_technology->save();
        }
    }
}
