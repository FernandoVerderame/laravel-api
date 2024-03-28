<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color', 'icon'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }
}
