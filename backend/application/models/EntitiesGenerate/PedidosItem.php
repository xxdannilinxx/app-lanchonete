<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * PedidosItem
 *
 * @Table(name="pedidos_item", indexes={@Index(name="fk_item_pedido_idx", columns={"pedido"}), @Index(name="fk_item_produto_idx", columns={"produto"})})
 * @Entity
 */
class PedidosItem
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
    private $valor;

    /**
     * @var string
     *
     * @Column(name="descricao", type="string", length=255, nullable=false)
     */
    private $descricao;

    /**
     * @var int
     *
     * @Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

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
     * @var \Pedidos
     *
     * @ManyToOne(targetEntity="Pedidos")
     * @JoinColumns({
     *   @JoinColumn(name="pedido", referencedColumnName="id")
     * })
     */
    private $pedido;

    /**
     * @var \Produtos
     *
     * @ManyToOne(targetEntity="Produtos")
     * @JoinColumns({
     *   @JoinColumn(name="produto", referencedColumnName="id")
     * })
     */
    private $produto;


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
     * @return PedidosItem
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
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return PedidosItem
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set quantidade.
     *
     * @param int $quantidade
     *
     * @return PedidosItem
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade.
     *
     * @return int
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set observacao.
     *
     * @param string|null $observacao
     *
     * @return PedidosItem
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
     * @return PedidosItem
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
     * @return PedidosItem
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
     * Set pedido.
     *
     * @param \Pedidos|null $pedido
     *
     * @return PedidosItem
     */
    public function setPedido(\Pedidos $pedido = null)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido.
     *
     * @return \Pedidos|null
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set produto.
     *
     * @param \Produtos|null $produto
     *
     * @return PedidosItem
     */
    public function setProduto(\Produtos $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto.
     *
     * @return \Produtos|null
     */
    public function getProduto()
    {
        return $this->produto;
    }
}
