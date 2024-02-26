<?php

namespace App\Enum\Estoque\Grupo;

enum TipoGrupoEnum: string
{
  use TipoGrupoEnumArray;
  case PRODUTO_FINAL = 'Produto Final';
  case REVENDA = 'Revenda';
  case MATERIA_PRIMA = 'Matéria Prima';
  case EMBALAGEM = 'Embalagem';
  case SERVICOS = 'Serviços';
  case OUTROS = 'Outros';
}

trait TipoGrupoEnumArray {
  protected static function nome(): array {
    return array_column(self::cases(), 'name');
  }
  protected static function valor(): array {
    return array_column(self::cases(), 'value');
  }

  public static function toArray(): array {
    return array_combine(self::nome(), self::valor());
  }
}
