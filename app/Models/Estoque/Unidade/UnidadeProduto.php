<?php

namespace App\Models\Estoque\Unidade;

use App\Models\Empresa\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnidadeProduto extends Model
{
    use HasFactory;

    protected $table = 'unidade_produto';

    protected $fillable = [
      'empresa_id',
      'unidade_produto_nome'
    ];

    public function empresa(): BelongsTo {
      return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }
}
