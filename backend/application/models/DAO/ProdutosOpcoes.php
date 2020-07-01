<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class ProdutosOpcoes extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial po.{id,obrigatorio}', 'partial o.{id,nome}')
            ->from('Entities\ProdutosOpcoes', 'po')
            ->leftjoin('po.produto', 'p')
            ->leftjoin('po.opcao', 'o')
            ->where("po.situacao <> 'desativado'")
            ->orderBy('po.id', 'asc');
        $this->usarFiltro($qb, $filtros, 'p');

        return $qb->getQuery()->getArrayResult();
    }
}
