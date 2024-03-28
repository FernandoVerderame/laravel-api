<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');

        $title = fake()->text(20);
        $slug = Str::slug($title);
        $img = fake()->image(null, 250, 250);

        $img_url = Storage::putFileAs('project_images', $img, "$slug.png");

        $type_ids = Type::pluck('id')->toArray();
        $type_ids[] = null;

        return [
            'title' => $title,
            'slug' => $slug,
            'type_id' => Arr::random($type_ids),
            'description' => fake()->paragraphs(15, true),
            'image' => $img_url,
            'is_completed' => fake()->boolean()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            $technology_ids = Technology::pluck('id')->toArray();
            $project_technologies = array_filter($technology_ids, fn () => rand(0, 1));
            $project->technologies()->attach($project_technologies);
        });
    }
}
