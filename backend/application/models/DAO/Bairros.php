<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Bairros extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial b.{id,nome,valor}')
            ->from('Entities\Bairros', 'b')
            ->where("b.situacao <> 'desativado'")
            ->orderBy('b.nome', 'asc');
        $this->usarFiltro($qb, $filtros, 'b');

        return $qb->getQuery()->getArrayResult();
    }
}
