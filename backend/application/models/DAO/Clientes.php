<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function listar(): array
    {
        $listar = $this->em->createQueryBuilder()
            ->select('c')
            ->from('Entities\Clientes', 'c')
            ->where('c.situacao = ?0')
            ->setParameter(0, 'ativo');

        return $listar->getQuery()->getArrayResult();
    }

    public function verificarToken(string $token): array
    {
        $listar = $this->em->createQueryBuilder()
            ->select('c')
            ->from('Entities\Clientes', 'c')
            ->where('c.situacao = ?0')
            ->setParameter(0, 'ativo')
            ->andWhere('c.token = ?1')
            ->setParameter(1, $token);

        return $listar->getQuery()->getArrayResult();
    }
}
