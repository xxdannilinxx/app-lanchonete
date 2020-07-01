<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pedidos
 *
 * @Table(name="pedidos", indexes={@Index(name="fk_pedido_cliente_endereco_idx", columns={"endereco"}), @Index(name="fk_pedido_cliente_idx", columns={"cliente"}), @Index(name="fk_pedido_cupom_idx", columns={"cupom"}), @Index(name="fk_pedido_forma_de_pagamento_idx", columns={"formaDePagamento"})})
 * @Entity
 */
class Pedidos
{
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
    private $valor = '0';

    /**
     * @var float
     *
     * @Column(name="valorEntrega", type="float", precision=10, scale=0, nullable=false)
     */
    private $valorentrega = '0';

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
     * @var \Enderecos
     *
     * @ManyToOne(targetEntity="Enderecos")
     * @JoinColumns({
     *   @JoinColumn(name="endereco", referencedColumnName="id")
     * })
     */
    private $endereco;

    /**
     * @var \Cuponsdedesconto
     *
     * @ManyToOne(targetEntity="Cuponsdedesconto")
     * @JoinColumns({
     *   @JoinColumn(name="cupom", referencedColumnName="id")
     * })
     */
    private $cupom;

    /**
     * @var \Formasdepagamento
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
    public function setValorentrega($valorentrega)
    {
        $this->valorentrega = $valorentrega;

        return $this;
    }

    /**
     * Get valorentrega.
     *
     * @return float
     */
    public function getValorentrega()
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
     * @param \Clientes|null $cliente
     *
     * @return Pedidos
     */
    public function setCliente(\Clientes $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente.
     *
     * @return \Clientes|null
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set endereco.
     *
     * @param \Enderecos|null $endereco
     *
     * @return Pedidos
     */
    public function setEndereco(\Enderecos $endereco = null)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco.
     *
     * @return \Enderecos|null
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set cupom.
     *
     * @param \Cuponsdedesconto|null $cupom
     *
     * @return Pedidos
     */
    public function setCupom(\Cuponsdedesconto $cupom = null)
    {
        $this->cupom = $cupom;

        return $this;
    }

    /**
     * Get cupom.
     *
     * @return \Cuponsdedesconto|null
     */
    public function getCupom()
    {
        return $this->cupom;
    }

    /**
     * Set formadepagamento.
     *
     * @param \Formasdepagamento|null $formadepagamento
     *
     * @return Pedidos
     */
    public function setFormadepagamento(\Formasdepagamento $formadepagamento = null)
    {
        $this->formadepagamento = $formadepagamento;

        return $this;
    }

    /**
     * Get formadepagamento.
     *
     * @return \Formasdepagamento|null
     */
    public function getFormadepagamento()
    {
        return $this->formadepagamento;
    }
}
