<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class stokModel extends Model
{
    use HasFactory;

    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'barang_id', 
        'user_id',
        'stok_tanggal', 
        'stok_jumlah'
    ];

    public function barang(): BelongsTo{
        return $this->BelongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    public function user(): BelongsTo{
        return $this->BelongsTo(UserModel::class, 'user_id', 'user_id');
    }

    protected $casts = [
        'stok_tanggal' => 'date:d/m/Y',
    ];
}