<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produtos
 *
 * @Table(name="produtos", indexes={@Index(name="fk_categoria_produto_idx", columns={"categoria"})})
 * @Entity
 */
class Produtos
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
     * @var string
     *
     * @Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @Column(name="descricao", type="string", length=45, nullable=false)
     */
    private $descricao;

    /**
     * @var float
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor = '0';

    /**
     * @var string
     *
     * @Column(name="imagem", type="string", length=65535, nullable=false)
     */
    private $imagem;

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
     * @var \Entities\Categorias
     *
     * @ManyToOne(targetEntity="Categorias")
     * @JoinColumns({
     *   @JoinColumn(name="categoria", referencedColumnName="id")
     * })
     */
    private $categoria;


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
     * Set nome.
     *
     * @param string $nome
     *
     * @return Produtos
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome.
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descricao.
     *
     * @param string $descricao
     *
     * @return Produtos
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
     * Set valor.
     *
     * @param float $valor
     *
     * @return Produtos
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
     * Set imagem.
     *
     * @param string $imagem
     *
     * @return Produtos
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem.
     *
     * @return string
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Produtos
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
     * @return Produtos
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
     * Set categoria.
     *
     * @param \Entities\Categorias|null $categoria
     *
     * @return Produtos
     */
    public function setCategoria(\Entities\Categorias $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria.
     *
     * @return \Entities\Categorias|null
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
