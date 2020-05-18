<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(array $filtros = []): array
    {
        $qb = $this->em->createQueryBuilder();
        
        $qb->select('ct.id, ct.nome')
            ->from('Entities\Categorias', 'ct')
            ->where('ct.situacao = ?0')
            ->setParameter(0, 'ativo');

        return $qb->getQuery()->getArrayResult();
    }
}