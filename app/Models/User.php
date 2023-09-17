<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PhpParser\Node\Expr\FuncCall;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "username"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        "last_day" => "date"
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //almacena los usuarios que siguen a este usuario

    //aca lo que hacemos es una relacion de muchos a muchos, porque un usuario puede seguir a muchos usuarios y un usuario puede ser seguido por muchos usuarios

    //estamos relacionando la tabla users con la tabla followers y le decimos que la tabla pivote es followers y que la llave foranea de la tabla users es user_id y la llave foranea de la tabla followers es follower_id

    //este usuario va a tener este metodo de followers y va a insertar en la tabla de followers el user id y el follower id


    public function followers(){
        return $this->belongsToMany(User::class, "followers", "user_id", "follower_id");
    }

    //comprobar si un usuario ya sigue a otro

    public function siguiendo(User $user){
        return $this->followers->contains($user->id);
    }

    //almacenar los que seguimos

    public function followings(){
        return $this->belongsToMany(User::class, "followers", "follower_id", "user_id");
    }
}
