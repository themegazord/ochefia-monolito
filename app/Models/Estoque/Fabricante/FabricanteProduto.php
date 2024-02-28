<?php

namespace App\Models\Estoque\Fabricante;

use App\Models\Empresa\Empresa;
use App\Models\Estoque\Produto\Produto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FabricanteProduto extends Model
{
    use HasFactory;

    protected $table = 'fabricante_produto';

    protected $fillable = [
      'empresa_id',
      'fabricante_produto_nome'
    ];

    public function empresa(): BelongsTo {
      return $this->belongsTo(Empresa::class, 'empresa_id', 'empresa_id');
    }

    public function produto(): HasMany {
      return $this->hasMany(Produto::class, 'fabricante_produto_id', 'fabricante_produto_id');
    }
}
