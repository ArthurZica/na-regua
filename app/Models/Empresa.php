<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Empresa extends Model
{
    protected $fillable = [
        'name', 'cnpj', 'endereco', 'telefone'
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_empresa', 'empresa_id', 'user_id');
    }
}
