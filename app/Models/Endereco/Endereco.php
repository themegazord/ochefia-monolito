<?php

namespace App\Models\Endereco;

use App\Models\Cliente\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Endereco extends Model
{
  use HasFactory;

  protected $fillable = [
      'endereco_rua',
      'endereco_numero',
      'endereco_complemento',
      'endereco_cep',
      'endereco_bairro',
      'endereco_cidade',
  ];

  public function cliente(): HasOne
  {
    return $this->hasOne(Cliente::class, 'endereco_id', 'endereco_id');
  }
}
