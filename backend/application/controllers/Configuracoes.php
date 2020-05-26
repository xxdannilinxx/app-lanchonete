<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Configuracoes extends MY_Controller
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
			/**
			 * 
			 */
			$DAOConfiguracoes = new DAO\Configuracoes();
			$retorno = $DAOConfiguracoes->lista();

			return $this->setReturn(true, 'Configurações exportadas com sucesso.', current($retorno));
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
