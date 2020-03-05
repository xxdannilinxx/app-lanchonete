<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicial extends MY_Controller {

	public function index()
	{
		$this->death('Ops, não pode ser acessado diretamente.');
	}
}
