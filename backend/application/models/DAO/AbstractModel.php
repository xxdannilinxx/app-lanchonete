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

    public function usarFiltro(object $qb, object $filtros = null, string $padrao = null): object
    {
        if ($filtros) {
            foreach ($filtros as $filtro => $valor) {
                switch ($filtro) {
                    case 'max':
                        $qb->setMaxResults($valor);
                        break;
                    case 'offset':
                        $qb->setFirstResult($valor);
                        break;
                    default:
                        $filtro = ($padrao && !preg_match('/[.]/', $filtro) ? "{$padrao}.{$filtro}" : $filtro);
                        $qb->andWhere("{$filtro} = '{$valor}'");
                }
            }
        }
        return $qb;
    }
}
