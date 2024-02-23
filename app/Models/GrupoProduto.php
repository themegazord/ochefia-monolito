<?php

namespace App\Models;

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

    public function empresa(): BelongsTo {
      $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }
}
