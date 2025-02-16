<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author_id', 'description', 'progress',
        'date_added', 'started_reading', 'finished_reading','total_pages'];
    public function author() {
        return $this->belongsTo(Author::class);
    }
    public function genres() {
        return $this->belongsToMany(Genre::class);
    }
    public function quotes() {
        return $this->hasMany(Quote::class);
    }
}
