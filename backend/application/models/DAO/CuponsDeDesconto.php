<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class CuponsDeDesconto extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial cp.{id,nome,porcentagem}')
            ->from('Entities\CuponsDeDesconto', 'cp')
            ->where("cp.situacao <> 'desativado'")
            ->orderBy('cp.nome', 'asc');
        $this->usarFiltro($qb, $filtros, 'cp');

        return $qb->getQuery()->getArrayResult();
    }
}
