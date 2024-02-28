<?php

namespace App\Models\Empresa;

use App\Models\Estoque\Classe\ClasseProduto;
use App\Models\Estoque\Fabricante\FabricanteProduto;
use App\Models\Estoque\Grupo\GrupoProduto;
use App\Models\Estoque\Produto\Produto;
use App\Models\Estoque\SubGrupo\SubGrupoProduto;
use App\Models\Estoque\Unidade\UnidadeProduto;
use App\Models\Funcionario\Funcionario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

// use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
  use HasFactory;

  protected $fillable = [
      'empresa_nome',
      'empresa_cnpj',
      'empresa_descricao',
      'empresa_logo'
  ];

  public function funcionario(): HasOne
  {
    return $this->hasOne(Funcionario::class, 'empresa_id', 'empresa_id');
  }

  public function classe_produto(): HasMany {
    return $this->hasMany(ClasseProduto::class, 'empresa_id', 'empresa_id');
  }

  public function fabricante_produto(): HasMany {
    return $this->hasMany(FabricanteProduto::class, 'empresa_id', 'empresa_id');
  }

  public function grupo_produto(): HasMany {
    return $this->hasMany(GrupoProduto::class, 'empresa_id', 'empresa_id');
  }

  public function subgrupo_produto(): HasMany {
    return $this->hasMany(SubGrupoProduto::class, 'empresa_id', 'empresa_id');
  }

  public function unidade_produto(): HasMany {
    return $this->hasMany(UnidadeProduto::class, 'empresa_id', 'empresa_id');
  }

   public function produto(): HasMany {
       return $this->hasMany(Produto::class, 'empresa_id', 'empresa_id');
   }

  // public function prazoPgtos(): HasMany {
  //     return $this->hasMany(PrazoPgto::class, 'empresa_id', 'empresa_id');
  // }

  // public function prazoPgtoDias(): HasMany {
  //     return $this->hasMany(PrazoPgtoDias::class, 'empresa_id', 'empresa_id');
  // }
}
