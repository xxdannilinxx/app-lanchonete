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

        $qb->select('p.id, p.nome, p.descricao, p.valor, p.categoria, p.imagem')
            ->from('Entities\Produtos', 'p');
        $qb->andWhere("p.situacao = 'ativo'");
        $this->usarFiltro($qb, $filtros);

        return $qb->getQuery()->getArrayResult();
    }
}
