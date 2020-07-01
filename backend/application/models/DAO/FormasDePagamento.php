<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class FormasDePagamento extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial fp.{id,nome,troco}')
            ->from('Entities\FormasDePagamento', 'fp')
            ->where("fp.situacao <> 'desativado'")
            ->orderBy('fp.nome', 'asc');
        $this->usarFiltro($qb, $filtros, 'fp');

        return $qb->getQuery()->getArrayResult();
    }
}
