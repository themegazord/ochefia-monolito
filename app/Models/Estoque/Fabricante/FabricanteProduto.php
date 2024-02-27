<?php

namespace App\Models\Estoque\Fabricante;

use App\Models\Empresa\Empresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
