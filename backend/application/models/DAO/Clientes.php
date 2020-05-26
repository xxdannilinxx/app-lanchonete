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
            ->from('Entities\Clientes', 'c');
        $qb->where("c.situacao = 'ativo'");
        $this->usarFiltro($qb, $filtros);

        return $qb->getQuery()->getArrayResult();
    }

    public function verificarToken(string $token): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('c.token')
            ->from('Entities\Clientes', 'c')
            ->where("c.situacao = 'ativo'")
            ->andWhere("c.token = '{$token}'");

        return $qb->getQuery()->getArrayResult();
    }
}
