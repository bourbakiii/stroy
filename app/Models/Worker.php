<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'type_id',
        'age',
        'gender',
    ];
    public function typeOfWorker()
    {
        return $this->belongsTo(TypeOfWorkers::class, 'type_id');
    }

    public function brigades()
    {
        return $this->hasManyThrough(Brigade::class, BrigadesConnection::class, 'worker_id', 'id', 'id', 'brigade_id');
    }
}
