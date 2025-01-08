<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardItemFile extends Model
{
    protected $table = 'board_item_files';

    protected $fillable = [
        'board_item_id',
        'file',
    ];
    
    public function boardItem()
    {
        return $this->belongsTo(BoardItem::class, 'board_item_id', 'id');
    }
}
