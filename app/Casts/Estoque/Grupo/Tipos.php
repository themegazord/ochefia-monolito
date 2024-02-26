<?php

namespace App\Casts\Estoque\Grupo;

use App\Enum\Estoque\Grupo\TipoGrupoEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Tipos implements CastsAttributes
{

  /**
   * Cast the given value.
   *
   * @param array<string, mixed> $attributes
   */
  public function get(Model $model, string $key, mixed $value, array $attributes): string
  {
    return TipoGrupoEnum::tipoEspecifico($value);
  }

  /**
   * Prepare the given value for storage.
   *
   * @param array<string, mixed> $attributes
   */
  public function set(Model $model, string $key, mixed $value, array $attributes): mixed
  {
    return $value;
  }
}
