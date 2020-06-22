<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Enderecos extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('partial e.{id,titulo,endereco,complemento}', 'partial b.{id,nome}')
            ->from('Entities\Enderecos', 'e')
            ->leftjoin('e.bairro', 'b')
            ->leftjoin('e.cliente', 'c')
            ->where("e.situacao = 'ativo'")
            ->andWhere("c.situacao = 'ativo'")
            ->orderBy('e.id', 'desc');
        $this->usarFiltro($qb, $filtros, 'e');


        return $qb->getQuery()->getArrayResult();
    }
}
