<?php

namespace App\Repository;

use App\Models\Datasys;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Exists;

/**
 * class DatasysRepository
 * @author Thiago Silva <thiago.silva@ntsistemasweb.dev.br>
 */
class DatasysRepository
{

  protected $entity;

  /**
   *
   * @param Datasys $datasys
   */
  public function __construct(Datasys $datasys)
  {
    $this->entity = $datasys;
  }

  public function saveDatasys(array $data)
  {
    Log::info('Salvando Dados Datasys');
    foreach ($data as $row) {
      try {
        if ($this->entity->where('id_venda', $row['id_venda'])->where('modalidade', $row['modalidade'])->count() == 0) {
          $this->entity->create($row);
        }
      } catch (Exception $e) {
        Log::error($e->getMessage());
        Log::error('Dados com Erro ' . json_encode($data));
      }
    }
  }

  public function findDatasys($tenant_id, $modalidade)
  {
    $pesquisa = $modalidade;
    $array = explode(";", $pesquisa);

    if ($modalidade == null) {
      $datasys = $this->entity->where('tenant_id', $tenant_id)
        ->get();
      return $datasys;
    }

    $datasys = $this->entity->where('tenant_id', $tenant_id)
      ->whereIn('modalidade', $array)
      ->get();

    return $datasys;
  }

  public function delete($tenant_id)
  {
    $this->entity->where('tenant_id', $tenant_id)->delete();
  }
}
