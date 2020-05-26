<?php

defined('BASEPATH') or exit('No direct script access allowed');

class App extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function gerarEntities(): object
	{
		try {
			$doctrine = new Doctrine();
			$resultado = $doctrine->gerarEntities();

			if (!$resultado) {
				throw new \Exception('Erro desconhecido ao gerar entities.');
			}

			return $this->setReturn(true, 'Entities geradas com sucesso.');
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
