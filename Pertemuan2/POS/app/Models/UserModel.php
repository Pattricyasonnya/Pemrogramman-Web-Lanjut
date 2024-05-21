<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Databse\Eloqouent\Cats\Attribute;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    use HasFactory;

    protected $table = 'm_user';
    public $timestamps = true;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'level_id', 
        'username', 
        'nama', 
        'password',
        'profil_img',
        'status',
        'image'
    ];

        // hidden : berisi data yg disembunyikan
        protected $hidden = [
            'password',
        ];

        //password otomatis ke hash
        protected $casts = [
            'password' => 'hashed',
        ];

    public function level():BelongsTo{
        return $this -> belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function image(): CastsAttribute{
        return CastsAttribute::make(
            get: fn($image)=> url('/storage/posts' .$image),
        );
    }
}
