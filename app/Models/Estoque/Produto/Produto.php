<?php

namespace App\Models\Estoque\Produto;

use App\Models\Empresa\Empresa;
use App\Models\Estoque\Classe\ClasseProduto;
use App\Models\Estoque\Fabricante\FabricanteProduto;
use App\Models\Estoque\Grupo\GrupoProduto;
use App\Models\Estoque\SubGrupo\SubGrupoProduto;
use App\Models\Estoque\Unidade\UnidadeProduto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
  use HasFactory;

  protected $fillable = [
    'empresa_id',
    'grupo_produto_id',
    'subgrupo_produto_id',
    'fabricante_produto_id',
    'classe_produto_id',
    'unidade_produto_id',
    'produto_nome',
    'produto_estoque',
    'produto_preco'
  ];

  public function empresa(): BelongsTo
  {
    return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
  }

  public function grupo_produto(): BelongsTo
  {
    return $this->belongsTo(GrupoProduto::class, 'grupo_produto_id', 'grupo_produto_id');
  }

  public function subgrupo_produto(): BelongsTo
  {
    return $this->belongsTo(SubGrupoProduto::class, 'subgrupo_produto_id', 'subgrupo_produto_id');
  }

  public function fabricante_produto(): BelongsTo
  {
    return $this->belongsTo(FabricanteProduto::class, 'fabricante_produto_id', 'fabricante_produto_id');
  }

  public function classe_produto(): BelongsTo
  {
    return $this->belongsTo(ClasseProduto::class, 'classe_produto_id', 'classe_produto_id');
  }

  public function unidade(): BelongsTo
  {
    return $this->belongsTo(UnidadeProduto::class, 'unidade_produto_id', 'unidade_produto_id');
  }
}
