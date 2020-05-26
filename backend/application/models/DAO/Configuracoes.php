<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Configuracoes extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function carregar(): array
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('config')
            ->from('Entities\Configuracoes', 'config')
            ->setMaxResults(1);

        return $qb->getQuery()->getArrayResult();
    }
}
