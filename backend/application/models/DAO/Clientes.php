<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function verificarToken(string $token, int $nivel): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('c.token')
            ->from('Entities\Clientes', 'c')
            ->where("c.situacao <> 'desativado'")
            ->andWhere("c.token = '{$token}'");
        if ($nivel > 0) {
            $qb->andWhere("c.nivel = '{$nivel}'");
        }

        return $qb->getQuery()->getArrayResult();
    }
}
