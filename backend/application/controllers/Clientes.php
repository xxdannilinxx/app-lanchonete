<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lista(array $filtros = []): object
	{
		try {
			$verificarApi = $this->verificarApi('GET');
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
            }
            /**
             * 
             */
            $filtros = ($filtros ? $filtros : $this->input->get());

			$DAOClientes = new DAO\Clientes();
			$retorno = $DAOClientes->lista($filtros);

			return $this->setReturn(true, 'Lista de clientes obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
