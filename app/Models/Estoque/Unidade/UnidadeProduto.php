<?php

namespace App\Models\Estoque\Unidade;

use App\Models\Empresa\Empresa;
use App\Models\Estoque\Produto\Produto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnidadeProduto extends Model
{
    use HasFactory;

    protected $table = 'unidade_produto';

    protected $fillable = [
      'empresa_id',
      'unidade_produto_nome',
      'unidade_produto_sigla',
    ];

    public function empresa(): BelongsTo {
      return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }

    public function produto(): HasMany {
      return $this->hasMany(Produto::class, 'unidade_produto_id', 'unidade_produto_id');
    }
}
