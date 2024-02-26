<?php

namespace App\Enum\Estoque\Grupo;

use App\Traits\Estoque\Grupo\TipoGrupoTrait;

enum TipoGrupoEnum: string
{
  use TipoGrupoTrait;
  case PRODUTO_FINAL = 'Produto Final';
  case REVENDA = 'Revenda';
  case MATERIA_PRIMA = 'Matéria Prima';
  case EMBALAGEM = 'Embalagem';
  case SERVICOS = 'Serviços';
  case OUTROS = 'Outros';
}
