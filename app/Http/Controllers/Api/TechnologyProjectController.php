<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyProjectController extends Controller
{
    public function __invoke(string $slug)
    {
        $technology = Technology::whereSlug($slug)->first();
        if (!$technology) return response(null, 404);

        $technology_id = $technology->id;

        $projects = Project::whereIsCompleted(true)->whereHas('technologies', function ($query) use ($technology_id) {
            $query->where('technology_id', $technology_id);
        })->with('type', 'technologies')->get();

        return response()->json(['projects' => $projects, 'label' => $technology->label]);
    }
}
