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
     * @var int
     *
     * @Column(name="opcao", type="integer", nullable=false)
     */
    private $opcao;

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
     * Set opcao.
     *
     * @param int $opcao
     *
     * @return ProdutosOpcoes
     */
    public function setOpcao($opcao)
    {
        $this->opcao = $opcao;

        return $this;
    }

    /**
     * Get opcao.
     *
     * @return int
     */
    public function getOpcao()
    {
        return $this->opcao;
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
}
