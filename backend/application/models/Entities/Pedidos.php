<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @Table(name="pedidos", indexes={@Index(name="fk_pedido_cliente_idx", columns={"cliente"}), @Index(name="fk_pedido_cupom_idx", columns={"cupom"}), @Index(name="fk_pedido_forma_de_pagamento_idx", columns={"formaDePagamento"})})
 * @Entity
 */
class Pedidos
{
    public function __construct()
    {
        $this->data = new \DateTime(date('Y-m-d H:i:s'));
    }

    /**
     * @var int
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor;

    /**
     * @var float
     *
     * @Column(name="valorentrega", type="float", precision=10, scale=0, nullable=false)
     */
    private $valorentrega;

    /**
     * @var float|null
     *
     * @Column(name="troco", type="float", precision=10, scale=0, nullable=true)
     */
    private $troco;

    /**
     * @var string|null
     *
     * @Column(name="observacao", type="string", length=255, nullable=true)
     */
    private $observacao;

    /**
     * @var \Entities\Enderecos
     *
     * @ManyToOne(targetEntity="Enderecos")
     * @JoinColumns({
     *   @JoinColumn(name="endereco", referencedColumnName="id")
     * })
     */
    private $endereco;

    /**
     * @var string|null
     *
     * @Column(name="situacao", type="string", length=45, nullable=true, options={"default"="ativo"})
     */
    private $situacao = 'ativo';

    /**
     * @var \DateTime|null
     *
     * @Column(name="data", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $data = 'CURRENT_TIMESTAMP';

    /**
     * @var \Clientes
     *
     * @ManyToOne(targetEntity="Clientes")
     * @JoinColumns({
     *   @JoinColumn(name="cliente", referencedColumnName="id")
     * })
     */
    private $cliente;

    /**
     * @var \Entities\Cuponsdedesconto
     *
     * @ManyToOne(targetEntity="Cuponsdedesconto")
     * @JoinColumns({
     *   @JoinColumn(name="cupom", referencedColumnName="id")
     * })
     */
    private $cupom;

    /**
     * @var \Entities\Formasdepagamento
     *
     * @ManyToOne(targetEntity="Formasdepagamento")
     * @JoinColumns({
     *   @JoinColumn(name="formaDePagamento", referencedColumnName="id")
     * })
     */
    private $formadepagamento;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valor.
     *
     * @param float $valor
     *
     * @return Pedidos
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set valorentrega.
     *
     * @param float $valorentrega
     *
     * @return Pedidos
     */
    public function setValorEntrega($valorentrega)
    {
        $this->valorentrega = $valorentrega;

        return $this;
    }

    /**
     * Get valorentrega.
     *
     * @return float
     */
    public function getValorEntrega()
    {
        return $this->valorentrega;
    }

    /**
     * Set troco.
     *
     * @param float|null $troco
     *
     * @return Pedidos
     */
    public function setTroco($troco = null)
    {
        $this->troco = $troco;

        return $this;
    }

    /**
     * Get troco.
     *
     * @return float|null
     */
    public function getTroco()
    {
        return $this->troco;
    }

    /**
     * Set observacao.
     *
     * @param string|null $observacao
     *
     * @return Pedidos
     */
    public function setObservacao($observacao = null)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao.
     *
     * @return string|null
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set endereco.
     *
     * @param \Entities\Enderecos|null $endereco
     *
     * @return Pedidos
     */
    public function setEndereco(\Entities\Enderecos $endereco = null)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco.
     *
     * @return \Entities\Enderecos|null
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Pedidos
     */
    public function setSituacao($situacao = null)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get situacao.
     *
     * @return string|null
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set data.
     *
     * @param \DateTime|null $data
     *
     * @return Pedidos
     */
    public function setData($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return \DateTime|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set cliente.
     *
     * @param \Entities\Clientes|null $cliente
     *
     * @return Pedidos
     */
    public function setCliente(\Entities\Clientes $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente.
     *
     * @return \Entities\Clientes|null
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set cupom.
     *
     * @param \Entities\Cuponsdedesconto|null $cupom
     *
     * @return Pedidos
     */
    public function setCupom(\Entities\Cuponsdedesconto $cupom = null)
    {
        $this->cupom = $cupom;

        return $this;
    }

    /**
     * Get cupom.
     *
     * @return \Entities\Cuponsdedesconto|null
     */
    public function getCupom()
    {
        return $this->cupom;
    }

    /**
     * Set formadepagamento.
     *
     * @param \Entities\Formasdepagamento|null $formadepagamento
     *
     * @return Pedidos
     */
    public function setFormadepagamento(\Entities\Formasdepagamento $formadepagamento = null)
    {
        $this->formadepagamento = $formadepagamento;

        return $this;
    }

    /**
     * Get formadepagamento.
     *
     * @return \Entities\Formasdepagamento|null
     */
    public function getFormadepagamento()
    {
        return $this->formadepagamento;
    }
}
