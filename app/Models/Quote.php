<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['book_id','quote','page','notes'];
    public function books() {
        return $this->belongsTo(Book::class);
    }
}
