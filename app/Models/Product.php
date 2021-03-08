<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['name', 'url', 'description', 'price', 'category_id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('orderByPrice', function (Builder $builder) {
            $builder->orderBy('price', 'desc');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
    }

    public function sluggable(): array
    {
        return [
            'url' => [
                'source' => 'name'
            ]
        ];
    }
}
