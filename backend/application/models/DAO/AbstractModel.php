<?php

namespace DAO;

defined('BASEPATH') or exit('No direct script access allowed');

class AbstractModel
{

    public $CI = false;
    public $em = false;

    public function __construct($em = false)
    {
        $this->CI = &get_instance();
        $this->em = ($em ? $em : $this->CI->doctrine->em);
    }

    public function usarFiltro(object $qb, array $filtros = []): object
    {
        foreach ($filtros as $filtro => $valor) {
            switch ($filtro) {
                case 'max':
                    $qb->setMaxResults($valor);
                    break;
                case 'offset':
                    $qb->setFirstResult($valor);
                    break;
                default:
                    $qb->andWhere("{$filtro} = '{$valor}'");
            }
        }
        return $qb;
    }
}
