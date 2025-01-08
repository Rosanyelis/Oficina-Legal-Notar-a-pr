<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkSpace extends Model
{
    protected $table = 'work_spaces';

    protected $fillable = [
        'client_id',
        'user_id',
        'title',
        'description',
        'status',
    ];


    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function boards()
    {
        return $this->hasMany(Board::class, 'work_space_id', 'id');
    }
}
