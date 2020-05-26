<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends MY_Controller
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
			$DAOClientes = new DAO\Clientes();
			$retorno = $DAOClientes->lista($filtros);

			return $this->setReturn(true, 'Lista de clientes obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}

	public function alterar(array $dados = []): object
	{
		try {
			$verificarApi = $this->verificarApi('PUT', false);
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}
			/**
			 * 
			 */
			$dados = (object) ($dados ? $dados : $this->getPayload());
			/**
			 * 
			 */
			if ($this->token) {
				$entityCliente = $this->em->getRepository('Entities\Clientes')->findOneBy(['token' => $this->token]);
			} else {
				$entityCliente = $this->em->getRepository('Entities\Clientes')->findOneBy(['facebook' => $dados->facebook]);
			}
			if (!$entityCliente) {
				$entityCliente = new \Entities\Clientes();
				$entityCliente->setToken($this->gerarToken());
				if (!$dados->facebook) {
					throw new \Exception('O uid do facebook não foi informado.');
				}
				if (!$dados->email) {
					throw new \Exception('O email não foi informado.');
				}
				if (!$dados->nome) {
					throw new \Exception('O nome não foi informado.');
				}
			}
			/**
			 * 
			 */
			if ($dados->facebook) {
				$entityCliente->setFacebook($dados->facebook);
			}
			if ($dados->email) {
				$entityCliente->setEmail($dados->email);
			}
			if ($dados->nome) {
				$entityCliente->setNome($dados->nome);
			}
			/**
			 * 
			 */
			if ($dados->telefone) {
				$entityCliente->setTelefone($dados->telefone);
			}
			if ($dados->cpf) {
				$entityCliente->setCpf($dados->cpf);
			}
			if ($dados->configuracoes) {
				$entityCliente->setConfiguracoes($dados->configuracoes);
			}
			if ($dados->situacao) {
				$entityCliente->setSituacao($dados->situacao);
			}
			$retorno = $this->salvar($entityCliente);
			if (!$retorno) {
				throw new \Exception('Não foi possível alterar suas informações.');
			}

			return $this->setReturn(true, 'Informações alteradas com sucesso.', [
				'facebook' => $entityCliente->getFacebook(),
				'email' => $entityCliente->getEmail(),
				'nome' => $entityCliente->getNome(),
				'telefone' => $entityCliente->getTelefone(),
				'cpf' => $entityCliente->getCpf(),
				'nivel' => $entityCliente->getNivel(),
				'token' => $entityCliente->getToken(),
				'configuracoes' => $entityCliente->getConfiguracoes(),
				'situacao' => $entityCliente->getSituacao()
			]);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
