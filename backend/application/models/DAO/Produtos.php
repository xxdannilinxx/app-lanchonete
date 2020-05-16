<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(array $filtros = []): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('p.id, p.nome, p.descricao, p.valor, p.categoria')
            ->from('Entities\Produtos', 'p');
            if (!empty($filtros['categoria'])) {
                $qb->where('p.categoria = ?1')
                   ->setParameter(1, $filtros['categoria']);
            }
        $qb->andWhere('p.situacao = ?0')
           ->setParameter(0, 'ativo');

        return $qb->getQuery()->getArrayResult();
    }
}