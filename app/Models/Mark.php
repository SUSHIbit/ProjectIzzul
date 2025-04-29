<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'document_id',
        'user_id',
        'rubric_id',
        'score',
        'feedback',
    ];
    
    public function document()
    {
        return $this->belongsTo(Document::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function rubric()
    {
        return $this->belongsTo(Rubric::class);
    }
}