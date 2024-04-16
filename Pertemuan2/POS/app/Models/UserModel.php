<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
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
        'status'];

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
}
