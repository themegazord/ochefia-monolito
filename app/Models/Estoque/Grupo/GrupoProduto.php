<?php

namespace App\Models\Estoque\Grupo;

use App\Casts\Estoque\Grupo\Tipos;
use App\Models\Empresa\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrupoProduto extends Model
{
    use HasFactory;

    protected $table = 'grupo_produto';

    protected $fillable = [
      'empresa_id',
      'grupo_produto_nome',
      'grupo_produto_tipo'
    ];

    protected $casts = [
      'grupo_produto_tipo' => Tipos::class
    ];

    public function empresa(): BelongsTo {
      return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }
}
