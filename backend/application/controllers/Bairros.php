<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bairros extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lista(object $filtros = null): object
	{
		try {
			$verificarApi = $this->verificarApi('GET', false);
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}
			/**
			 * 
			 */
			$filtros = (object) ($filtros ? $filtros : $this->input->get());
			/**
			 * 
			 */
			$DAOBairros = new DAO\Bairros();
			$retorno = $DAOBairros->lista($filtros);
			if (!$retorno) {
				throw new \Exception('Nenhum bairro encontrado.');
			}

			return $this->setReturn(true, 'Lista de bairros obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
