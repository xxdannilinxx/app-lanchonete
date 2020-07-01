<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('partial p.{id,nome,descricao,valor,imagem}')
            ->from('Entities\Produtos', 'p')
            ->leftjoin('p.categoria', 'c')
            ->where("p.situacao <> 'desativado'")
            ->orderBy('p.id', 'asc');
        $this->usarFiltro($qb, $filtros, 'p');

        return $qb->getQuery()->getArrayResult();
    }
}
