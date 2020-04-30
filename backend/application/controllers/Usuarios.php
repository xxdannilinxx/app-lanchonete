<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function teste()
	{
		try {
			throw new Exception('1Ops, não pode ser acessado diretamente.');
		} catch (Exception $e) {
			$this->getException($e);
			$this->setSubmit(false, $e->getMessage(), []);
		}
	}
}
