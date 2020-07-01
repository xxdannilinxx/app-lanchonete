<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FormasDePagamento extends MY_Controller
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
			$DAOFormasDePagamento = new DAO\FormasDePagamento();
			$retorno = $DAOFormasDePagamento->lista($filtros);

			return $this->setReturn(true, 'Lista de formas de pagamento obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
