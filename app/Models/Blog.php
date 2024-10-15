<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Blog extends Model
// {
//     use HasFactory;

//     protected $fillable = ['title', 'content'];

//     public function user()
// {
//     return $this->belongsTo(User::class);
// }
// }


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    // Fields allowed for mass assignment
    protected $fillable = ['title', 'content', 'user_id'];

    // Relationship: Blog belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
