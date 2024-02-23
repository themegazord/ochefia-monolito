<?php

namespace App\Enum\Produto\Grupo;

enum TipoGrupoEnum
{
  case PRODUTO_FINAL;
  case MATERIA_PRIMA;
  case EMBALAGEM;
  case SERVICOS;
  case OUTROS;
}
