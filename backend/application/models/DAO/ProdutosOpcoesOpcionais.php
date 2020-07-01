<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class ProdutosOpcoesOpcionais extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial op.{id,nome,valor}')
            ->from('Entities\Opcionais', 'op')
            ->leftjoin('op.opcao', 'o')
            ->where("op.situacao <> 'desativado'")
            ->orderBy('op.id', 'asc');
        $this->usarFiltro($qb, $filtros, 'o');

        return $qb->getQuery()->getArrayResult();
    }
}
