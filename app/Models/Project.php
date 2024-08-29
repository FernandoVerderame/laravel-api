<?php

namespace App\Models;

use Illuminate\Support\Facades\Vite;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'description', 'is_completed', 'type_id'];

    public function getFormattedDate($column, $format = 'd-m-Y')
    {
        return Carbon::create($this->$column)->format($format);
    }

    public function printImage()
    {
        return Vite::asset('storage/' . $this->image);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    // Query Scope Complete
    public function scopeCompleteFilter(Builder $query, $status)
    {
        if (!$status) return $query;
        $value = $status === 'completed';
        return $query->whereIsCompleted($value);
    }

    // Query Scope Type
    public function scopeTypeFilter(Builder $query, $type_id)
    {
        if (!$type_id) return $query;
        return $query->whereTypeId($type_id);
    }

    // Query Scope Technology
    public function scopeTechnologyFilter(Builder $query, $technology_id)
    {
        if (!$technology_id) return $query;
        return $query->whereHas('technologies', function ($query) use ($technology_id) {
            $query->where('technologies.id', $technology_id);
        });
    }

    // Query Scope Relations
    public function scopeWithRelations(Builder $query)
    {
        return $query->with('type', 'technologies');
    }

    // Accessor
    public function image(): Attribute
    {
        return Attribute::make(fn($value) => $value && app('request')->is('api/*') ? url('storage/' . $value) : $value);
    }
}
