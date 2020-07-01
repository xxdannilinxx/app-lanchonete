<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProdutosOpcoes extends MY_Controller
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
			$retorno = [];
			$DAOProdutosOpcoes = new DAO\ProdutosOpcoes();
			$DAOProdutosOpcoesOpcionais = new DAO\ProdutosOpcoesOpcionais();
			$retorno = $DAOProdutosOpcoes->lista($filtros);
			foreach ($retorno as $chave => $opcao) {
				$retorno[$chave]['opcao']['opcionais'] = $DAOProdutosOpcoesOpcionais->lista((object) ['id' => $opcao['id']]);
			}

			return $this->setReturn(true, 'Lista de opões do produto obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
