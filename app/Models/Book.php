<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'id',  => primary key table Book
        'title',
        'category_id',// fk dari model category
        'description', 
        'quantity', 
        'pdf_path', 
        'cover_image_path',
        'user_id' // fk dari Model User
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // karena Book model di panggil hasMany di user, pasangan nya belongsTo ke model yang memanggil
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
