<?php

namespace App\Models\Estoque\Classe;

use App\Models\Empresa\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClasseProduto extends Model
{
  use HasFactory;

  protected $table = 'classe_produto';

  protected $fillable = [
    'empresa_id',
    'classe_produto_nome'
  ];

  public function empresa(): BelongsTo {
    return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
  }

//  public function produto(): HasMany {
//    return $this->hasMany(Produto::class, 'classe_produto_id', 'classe_produto_id');
//  }
}
