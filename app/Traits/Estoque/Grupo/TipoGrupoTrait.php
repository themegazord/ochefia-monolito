<?php

namespace App\Traits\Estoque\Grupo;

trait TipoGrupoTrait
{
  protected static function nome(): array {
    return array_column(self::cases(), 'name');
  }
  protected static function valor(): array {
    return array_column(self::cases(), 'value');
  }

  public static function toArray(): array {
    return array_combine(self::nome(), self::valor());
  }

  public static function tipoEspecifico(string $chave): string {
    return array_combine(self::nome(), self::valor())[$chave];
  }
}