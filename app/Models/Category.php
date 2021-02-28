<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'url', 'description'];

    public function setTitleAttribute($value)
    {
        return $this->attributes['title'] = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
        return $this->attributes['url'] = Str::slug($value);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sluggable(): array
    {
        return [
            'url' => [
                'source' => 'title'
            ]
        ];
    }
}
