<?php

use TheSeer\Tokenizer\Exception;

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function lista(array $filtros = null): object
	{
		try {
			/**
			 * verificação da api
			 */
			$verificarApi = $this->verificarApi('GET');
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}
			/**
			 * variáveis
			 */
			$filtros = [
				'af' => ["carro" => 1, "moto" => 2],
				'q' => 1
			];
			$filtros = (object) ($filtros ?? $this->input->get('filtros'));

			return $this->setReturn(true, 'Ok');
		} catch (\Exception $e) {
			return $this->getException($e, 'Não foi possível gerar a lista de usuários.');
		}
	}
}
