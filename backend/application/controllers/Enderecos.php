<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enderecos extends MY_Controller
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
			$filtros = (object) ($filtros ? $filtros : $this->input->get());
			/**
			 * 
			 */
			$filtros->{'c.token'} = $this->token;
			/**
			 * 
			 */
			$DAOEnderecos = new DAO\Enderecos();
			$retorno = $DAOEnderecos->lista($filtros);

			return $this->setReturn(true, 'Lista de endereços obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}

	public function alterar(array $dados = []): object
	{
		try {
			$verificarApi = $this->verificarApi('PUT');
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
			if ($dados->id) {
				$entityEndereco = $this->em->getRepository('Entities\Enderecos')->findOneBy(['id' => $dados->id]);
				if (!$entityEndereco) {
					$entityEndereco = new \Entities\Enderecos();
				}
				if ($entityEndereco->getCliente()->getToken() !== $this->token) {
					throw new \Exception('O endereço não pode ser alterado por você.');
				}
			} else {
				$entityEndereco = new \Entities\Enderecos();
			}
			/**
			 * 
			 */
			if ($dados->titulo) {
				$entityEndereco->setTitulo($dados->titulo);
			} else {
				throw new \Exception('Você precisa informar um título para o endereço.');
			}
			if ($dados->endereco) {
				$entityEndereco->setEndereco($dados->endereco);
			} else {
				throw new \Exception('Você precisa informar o endereço.');
			}
			if ($dados->complemento) {
				$entityEndereco->setComplemento($dados->complemento);
			} else {
				throw new \Exception('Você precisa informar o complemento do endereço.');
			}
			if ($dados->bairro) {
				$entityBairro = $this->em->find('\Entities\Bairros', $dados->bairro['id']);
				if (!$entityBairro) {
					throw new \Exception('O bairro informado não foi encontrado.');
				}
				$entityEndereco->setBairro($entityBairro);
			} else {
				throw new \Exception('Você precisa informar o bairro.');
			}
			$entityEndereco->setCliente($this->em->getRepository('\Entities\Clientes')->findOneBy(['token' => $this->token]));
			/**
			 * 
			 */
			$retorno = $this->salvar($entityEndereco);
			if (!$retorno) {
				throw new \Exception('Não foi possível alterar o endereço.');
			}

			return $this->setReturn(true, 'Endereço alterado com sucesso.', [
				'id' => $entityEndereco->getId(),
				'titulo' => $entityEndereco->getTitulo(),
				'endereco' => $entityEndereco->getEndereco(),
				'complemento' => $entityEndereco->getComplemento(),
				'bairro' => [
					'id' => $entityEndereco->getBairro()->getId(),
					'nome' => $entityEndereco->getBairro()->getNome(),
					'valor' => $entityEndereco->getBairro()->getValor()
				]
			]);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}

	public function remover(array $dados = []): object
	{
		try {
			$verificarApi = $this->verificarApi('DELETE');
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
			if ($dados->id) {
				$entityEndereco = $this->em->getRepository('Entities\Enderecos')->findOneBy(['id' => $dados->id]);
				if (!$entityEndereco) {
					throw new \Exception('O endereço não foi encontrado.');
				}
				if ($entityEndereco->getCliente()->getToken() !== $this->token) {
					throw new \Exception('O endereço não pode ser removido por você.');
				}
			} else {
				throw new \Exception('O endereço não foi informadoo.');
			}
			/**
			 * 
			 */
			$entityEndereco->setSituacao('desativado');
			$retorno = $this->salvar($entityEndereco);
			if (!$retorno) {
				throw new \Exception('Não foi possível remover o endereço.');
			}

			return $this->setReturn(true, 'Endereço removido com sucesso.', [
				'id' => $entityEndereco->getId()
			]);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}
}
