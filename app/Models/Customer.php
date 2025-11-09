<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'name',
        'phone',
        'id_wpp',
        'empresa_id',
    ];

    public function empresa(): BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
    protected function scopeByPhone($query,$phone){
        $phone = preg_replace('/\D/', '', $phone);
        $ddd = substr($phone, 0, 4);
        $phoneWithoutDDDAnd9 = substr($phone, 4);
        return $query->where('phone', 'like',"%$ddd%$phoneWithoutDDDAnd9%");
    }
}
