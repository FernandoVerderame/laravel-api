<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }
}
