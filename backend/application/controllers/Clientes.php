<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lista(): object
	{
		try {
			$verificarApi = $this->verificarApi('GET');
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}

			$DAOClientes = new DAO\Clientes();
			$retorno = $DAOClientes->listar();

			return $this->setReturn(true, 'Lista de clientes obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
