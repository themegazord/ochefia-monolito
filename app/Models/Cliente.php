<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'endereco_id',
        'cliente_nome',
        'cliente_email',
        'cliente_senha',
        'cliente_cpf',
        'cliente_telefone_pessoal',
        'cliente_telefone_contato'
    ];

    protected $hidden = [
        'cliente_senha'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function endereco(): BelongsTo {
        return $this->belongsTo(Endereco::class, 'endereco_id', 'endereco_id');
    }
}
