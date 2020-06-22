<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends MY_Controller
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
			$DAOCategorias = new DAO\Categorias();
			$retorno = $DAOCategorias->lista($filtros);
			if (!$retorno) {
				throw new \Exception('Nenhuma categoria encontrada.');
			}

			return $this->setReturn(true, 'Lista de categorias obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
