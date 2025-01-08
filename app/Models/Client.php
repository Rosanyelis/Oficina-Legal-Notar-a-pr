<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'firstname',
        'second_name',
        'lastname',
        'second_surname',
        'birthdate',
        'email',
        'phone',
        'urbanization',
        'number',
        'street',
        'village',
        'country',
        'zipcode',
        'medio_contactos_id',
        'materia_id',
        'juzgado_id',
    ];


    public function medio_contacto()
    {
        return $this->belongsTo(MedioContacto::class, 'medio_contactos_id', 'id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id', 'id');
    }

    public function juzgado()
    {
        return $this->belongsTo(Juzgado::class, 'juzgado_id', 'id');
    }

    public function workspace()
    {
        return $this->hasOne(WorkSpace::class, 'client_id', 'id');
    }


}
