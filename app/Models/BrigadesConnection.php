<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrigadesConnection extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        "worker_id",
        "brigade_id"
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function brigade()
    {
        return $this->belongsTo(Brigade::class, 'brigade_id');
    }
}
