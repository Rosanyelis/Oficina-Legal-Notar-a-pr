<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardItemComment extends Model
{
    protected $table = 'board_item_comments';

    protected $fillable = [
        'board_item_id',
        'user_id',
        'comment',
    ];

    public function boardItem()
    {
        return $this->belongsTo(BoardItem::class, 'board_item_id', 'id');
    }
}
