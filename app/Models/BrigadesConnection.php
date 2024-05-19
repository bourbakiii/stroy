<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrigadesConnection extends Model
{
    use HasFactory;

    public $fillable = [
        "worker_id", "brigade_id"
    ];
}
