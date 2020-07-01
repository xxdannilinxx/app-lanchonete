<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial c.{id,nome}')
            ->from('Entities\Categorias', 'c')
            ->where("c.situacao <> 'desativado'")
            ->orderBy('c.id', 'asc');
        $this->usarFiltro($qb, $filtros, 'c');

        return $qb->getQuery()->getArrayResult();
    }
}
