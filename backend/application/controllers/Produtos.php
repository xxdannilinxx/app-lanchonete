<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produtos extends MY_Controller
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
			/**
			 * 
			 */
			$retorno = [];
			$DAOProdutos = new DAO\Produtos();
			$DAOCategorias = new DAO\Categorias();
			$categorias = $DAOCategorias->lista($filtros);
			foreach ($categorias as $categoria) {
				$retorno[] = [
					'nome' => $categoria['nome'],
					'produtos' => $DAOProdutos->lista(['categoria' => $categoria['id']])
				];
			}

			return $this->setReturn(true, 'Lista de produtos obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
