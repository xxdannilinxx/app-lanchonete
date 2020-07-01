<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pedidos extends MY_Controller
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
			$DAOPedidos = new DAO\Pedidos();
			$retorno = $DAOPedidos->lista($filtros);
			foreach ($retorno as $chave => $pedido) {
				$retorno[$chave]['itens'] = $DAOPedidos->listaItens((object) ['id' => $pedido['id']]);
			}

			return $this->setReturn(true, 'Lista de pedidos obtida com êxito.', $retorno);
		} catch (\Exception $e) {
			return $this->getException($e);
		}
	}

	public function adicionar(array $dados = []): object
	{
		try {
			$verificarApi = $this->verificarApi('POST');
			if (!$verificarApi->success) {
				throw new \Exception($verificarApi->message);
			}
			/**
			 * 
			 */
			$this->em->getConnection()->beginTransaction();
			$dados = (object) ($dados ? $dados : $this->getPayload());
			/**
			 * 
			 */
			$entityPedido = new \Entities\Pedidos();
			$DAOConfiguracoes = new DAO\Configuracoes();
			/**
			 * 
			 */
			$entityPedido->setCliente($this->em->getRepository('\Entities\Clientes')->findOneBy(['token' => $this->token]));
			$carregarConfiguracoes = $DAOConfiguracoes->carregar();
			if (!$carregarConfiguracoes) {
				throw new \Exception('As configurações não foram exportadas.');
			}
			if (!$carregarConfiguracoes[0]['aberto']) {
				throw new \Exception('A loja está fechada e não está mais recebendo pedidos.');
			}
			if (!$dados->valor) {
				throw new \Exception('Valor do pedido não informado.');
			} else {
				$entityPedido->setValor($dados->valor);
			}
			if (!$dados->valorEntrega) {
				throw new \Exception('Valor do pedido não informado.');
			} else {
				$entityPedido->setValorEntrega($dados->valorEntrega);
			}
			if ($dados->troco > 0) {
				$entityPedido->setTroco(($dados->valor - $dados->troco));
			}
			if (!$dados->itens) {
				throw new \Exception('Os itens do pedido não foram encontrados.');
			}
			$entityEndereco = $this->em->getRepository('\Entities\Enderecos')->findOneBy(['id' => $dados->endereco, 'situacao' => 'ativo']);
			if (!$entityEndereco) {
				throw new \Exception('O endereço informado não foi encontrado.');
			} else {
				$entityPedido->setEndereco($entityEndereco);
			}
			$entityFormasDePagamento = $this->em->getRepository('\Entities\Formasdepagamento')->findOneBy(['id' => $dados->formaDePagamento, 'situacao' => 'ativo']);
			if (!$entityFormasDePagamento) {
				throw new \Exception('A forma de pagamento informada não foi encontrado.');
			} else {
				$entityPedido->setFormadepagamento($entityFormasDePagamento);
			}
			if ($dados->cupom) {
				$entityCuponsDeDesconto = $this->em->getRepository('\Entities\Cuponsdedesconto')->findOneBy(['id' => $dados->cupom, 'situacao' => 'ativo']);
				if (!$entityCuponsDeDesconto) {
					throw new \Exception('O cupom informado não foi encontrado.');
				} else {
					$entityPedido->setCupom($entityCuponsDeDesconto);
				}
			}
			$retorno = $this->salvar($entityPedido);
			if (!$retorno) {
				throw new \Exception('Não foi possível adicionar o pedido.');
			}
			/**
			 * 
			 */
			foreach ($dados->itens as $item) {
				$entityPedidosItem = new \Entities\PedidosItem($this->em);
				$entityPedidosItem->setPedido($retorno);
				if (!$item['valor']) {
					throw new \Exception('Produto sem valor não é permitido.');
				} else {
					$entityPedidosItem->setValor($item['valor']);
				}
				if (!$item['quantidade']) {
					throw new \Exception('Produto sem quantidade não é permitido.');
				} else {
					$entityPedidosItem->setQuantidade($item['quantidade']);
				}
				$entityProduto = $this->em->getRepository('\Entities\Produtos')->findOneBy(['id' => $item['produto'], 'situacao' => 'ativo']);
				if (!$entityProduto) {
					throw new \Exception('Um dos produtos do pedido não encontra-se mais disponível.');
				} else {
					$entityPedidosItem->setProduto($entityProduto);
				}
				$entityPedidosItem->setDescricao($item['descricao']);
				$entityPedidosItem->setObservacao($item['observacao']);
				$retornoItem = $this->salvar($entityPedidosItem);
				if (!$retornoItem) {
					throw new \Exception('Um produto não pode ser adicionado no pedido.');
				}
			}

			$this->em->getConnection()->commit();
			return $this->setReturn(true, 'Pedido adicionado com sucesso.', [
				'id' => $entityPedido->getId()
			]);
		} catch (\Exception $e) {
			$this->em->getConnection()->rollback();
			return $this->getException($e);
		}
	}
}
