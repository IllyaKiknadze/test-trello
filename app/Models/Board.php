<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id','_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, null, 'user_id', '_id');
    }
}
