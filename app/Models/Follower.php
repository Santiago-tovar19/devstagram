<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    //el protected fillable es para indicarle a laravel que campos se van a guardar en la base de datos como medida de seguridad

    protected $fillable = [
        "user_id",
        "follower_id"
    ];
}
