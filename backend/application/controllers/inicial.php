<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicial extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
	}

	public function index()
	{
		try {
			$this->death('Ops, não pode ser acessado diretamente.');
		} catch (Exception $e) {
			$this->getException($e);
		}
	}
}
