<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Configuracoes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function carregar(): object
	{
		try {
			$verificarApi = $this->verificarApi('GET', false);
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}
			/**
			 * 
			 */
			$DAOConfiguracoes = new DAO\Configuracoes();
			$retorno = $DAOConfiguracoes->carregar();
			if (!$retorno) {
				throw new \Exception('As configurações não foram exportadas.');
			}

			return $this->setReturn(true, 'Configurações exportadas com sucesso.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
