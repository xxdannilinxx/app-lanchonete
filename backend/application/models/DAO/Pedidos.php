<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('p', 'partial e.{id,titulo,endereco,complemento,bairro}', 'partial b.{id,nome}', 'partial cp.{id,nome}', 'partial fp.{id,nome}')
            ->from('\Entities\Pedidos', 'p')
            ->leftjoin('\Entities\PedidosItem', 'pi', 'WITH', 'pi.pedido = p.id')
            ->leftjoin('pi.produto', 'pr')
            ->leftjoin('p.cliente', 'c')
            ->leftjoin('p.endereco', 'e')
            ->leftjoin('e.bairro', 'b')
            ->leftjoin('p.cupom', 'cp')
            ->leftjoin('p.formadepagamento', 'fp')
            ->where("p.situacao <> 'desativado'")
            ->orderBy('p.id', 'desc');
        $this->usarFiltro($qb, $filtros, 'p');

        return $qb->getQuery()->getArrayResult();
    }

    public function listaItens(object $filtros = null): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('partial pi.{id,valor,quantidade}', 'partial pr.{id,nome}')
            ->from('\Entities\PedidosItem', 'pi')
            ->leftjoin('pi.produto', 'pr')
            ->leftjoin('pi.pedido', 'p')
            ->leftjoin('p.cliente', 'c')
            ->where("p.situacao <> 'desativado'")
            ->orderBy('pi.id', 'desc');
        $this->usarFiltro($qb, $filtros, 'p');

        return $qb->getQuery()->getArrayResult();
    }
}
