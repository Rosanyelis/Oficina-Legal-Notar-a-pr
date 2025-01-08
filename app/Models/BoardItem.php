<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardItem extends Model
{
    protected $table = 'board_items';

    protected $fillable = [
        'work_space_id',
        'board_id',
        'title',
        'start_date',
        'due_date',
        'start_time',
        'due_time',
        'description',
        'priority',
        'badge_text',
        'badge',
        'event_calendar',
        'billable_task',
        'time_billable_task'
    ];


    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(BoardItemFile::class, 'board_item_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(BoardItemComment::class, 'board_item_id', 'id');
    }
}
