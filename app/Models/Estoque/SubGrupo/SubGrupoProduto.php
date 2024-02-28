<?php

namespace App\Models\Estoque\SubGrupo;

use App\Models\Empresa\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubGrupoProduto extends Model
{
    use HasFactory;

  protected $table = 'subgrupo_produto';

  protected $fillable = [
    'empresa_id',
    'subgrupo_produto_nome'
  ];

  public function empresa(): BelongsTo {
    return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
  }

  public function produto(): HasMany {
    return $this->hasMany(Produto::class, 'subgrupo_produto_id', 'subgrupo_produto_id');
  }
}
