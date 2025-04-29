<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'max_score',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}