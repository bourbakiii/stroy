<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brigade extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        "name"
    ];

    public function workers()
    {
        return $this->belongsToMany(Worker::class, BrigadesConnection::class, 'brigade_id', 'worker_id');
    }
}
