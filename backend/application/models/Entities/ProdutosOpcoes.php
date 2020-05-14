<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutosOpcoes
 *
 * @Table(name="produtos_opcoes", indexes={@Index(name="fk_produto_produto_idx", columns={"produto"}), @Index(name="fk_produtos_opcoes_idx", columns={"opcao"})})
 * @Entity
 */
class ProdutosOpcoes
{

    public function __construct()
    {
        parent::__construct();
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
     * @var float|null
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=true)
     */
    private $valor = '0';

    /**
     * @var int
     *
     * @Column(name="minimo", type="integer", nullable=false)
     */
    private $minimo = '0';

    /**
     * @var int
     *
     * @Column(name="maximo", type="integer", nullable=false)
     */
    private $maximo = '0';

    /**
     * @var int
     *
     * @Column(name="obrigatorio", type="integer", nullable=false)
     */
    private $obrigatorio = '0';

    /**
     * @var int
     *
     * @Column(name="produto", type="integer", nullable=false)
     */
    private $produto;

    /**
     * @var string
     *
     * @Column(name="situacao", type="string", length=45, nullable=false)
     */
    private $situacao;

    /**
     * @var \DateTime
     *
     * @Column(name="data", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
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
     * @param float|null $valor
     *
     * @return ProdutosOpcoes
     */
    public function setValor($valor = null)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor.
     *
     * @return float|null
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set minimo.
     *
     * @param int $minimo
     *
     * @return ProdutosOpcoes
     */
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }

    /**
     * Get minimo.
     *
     * @return int
     */
    public function getMinimo()
    {
        return $this->minimo;
    }

    /**
     * Set maximo.
     *
     * @param int $maximo
     *
     * @return ProdutosOpcoes
     */
    public function setMaximo($maximo)
    {
        $this->maximo = $maximo;

        return $this;
    }

    /**
     * Get maximo.
     *
     * @return int
     */
    public function getMaximo()
    {
        return $this->maximo;
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
     * Set produto.
     *
     * @param int $produto
     *
     * @return ProdutosOpcoes
     */
    public function setProduto($produto)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto.
     *
     * @return int
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set situacao.
     *
     * @param string $situacao
     *
     * @return ProdutosOpcoes
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get situacao.
     *
     * @return string
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Set data.
     *
     * @param \DateTime $data
     *
     * @return ProdutosOpcoes
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return \DateTime
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
}
