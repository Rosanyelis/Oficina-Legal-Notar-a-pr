<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';

    protected $fillable = [
        'work_space_id',
        'title',
        'title_slug',
    ];

    public function workSpace()
    {
        return $this->belongsTo(WorkSpace::class, 'work_space_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(BoardItem::class, 'board_id', 'id');
    }
}
