<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(array $filtros = []): array
    {
        $qb = $this->em->createQueryBuilder();
        
        $qb->select('c')
            ->from('Entities\Clientes', 'c')
            ->where('c.situacao = ?0')
            ->setParameter(0, 'ativo');

        return $qb->getQuery()->getArrayResult();
    }

    public function verificarToken(string $token): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('c')
            ->from('Entities\Clientes', 'c')
            ->where('c.situacao = ?0')
            ->setParameter(0, 'ativo')
            ->andWhere('c.token = ?1')
            ->setParameter(1, $token);

        return $qb->getQuery()->getArrayResult();
    }
}
