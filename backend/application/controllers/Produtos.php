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

			$DAOProdutos = new DAO\Produtos();
			$retorno = $DAOProdutos->lista($filtros);

			return $this->setReturn(true, 'Lista de produtos obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}

	public function listaComCategorias()
	{
		try {
			$verificarApi = $this->verificarApi('GET');
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
            }
            /**
             * 
             */
			$retorno = [];
			$DAOProdutos = new DAO\Produtos();
			$DAOCategorias = new DAO\Categorias();
			$categorias = $DAOCategorias->lista();
			foreach($categorias as $categoria) {
				$retorno[] = [
					'nome' => $categoria['nome'],
					'produtos' => $DAOProdutos->lista(['categoria' => $categoria['id']])
				];
			}

			return $this->setReturn(true, 'Lista de produtos ordenado por categoria obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
