<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', '_id');
    }
}
