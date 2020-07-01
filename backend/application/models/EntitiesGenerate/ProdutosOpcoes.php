<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutosOpcoes
 *
 * @Table(name="produtos_opcoes", indexes={@Index(name="fk_produto_produto_idx", columns={"produto"}), @Index(name="fk_produtos_opcoes_idx", columns={"opcao"})})
 * @Entity
 */
class ProdutosOpcoes
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
     * @var int
     *
     * @Column(name="obrigatorio", type="integer", nullable=false)
     */
    private $obrigatorio = '0';

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
     * @var \Opcoes
     *
     * @ManyToOne(targetEntity="Opcoes")
     * @JoinColumns({
     *   @JoinColumn(name="opcao", referencedColumnName="id")
     * })
     */
    private $opcao;

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
     * Set obrigatorio.
     *
     * @param int $obrigatorio
     *
     * @return ProdutosOpcoes
     */
    public function setObrigatorio($obrigatorio)
    {
        $this->obrigatorio = $obrigatorio;

        return $this;
    }

    /**
     * Get obrigatorio.
     *
     * @return int
     */
    public function getObrigatorio()
    {
        return $this->obrigatorio;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return ProdutosOpcoes
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
     * @return ProdutosOpcoes
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
     * Set opcao.
     *
     * @param \Opcoes|null $opcao
     *
     * @return ProdutosOpcoes
     */
    public function setOpcao(\Opcoes $opcao = null)
    {
        $this->opcao = $opcao;

        return $this;
    }

    /**
     * Get opcao.
     *
     * @return \Opcoes|null
     */
    public function getOpcao()
    {
        return $this->opcao;
    }

    /**
     * Set produto.
     *
     * @param \Produtos|null $produto
     *
     * @return ProdutosOpcoes
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
