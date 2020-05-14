<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produtos
 *
 * @Table(name="produtos", indexes={@Index(name="fk_categoria_produto_idx", columns={"categoria"}), @Index(name="fk_imagem_arquivo_idx", columns={"imagem"})})
 * @Entity
 */
class Produtos
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
     * @var int
     *
     * @Column(name="categoria", type="integer", nullable=false)
     */
    private $categoria;

    /**
     * @var float
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=false)
     */
    private $valor = '0';

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
     * @var \Arquivos
     *
     * @ManyToOne(targetEntity="Arquivos")
     * @JoinColumns({
     *   @JoinColumn(name="imagem", referencedColumnName="id")
     * })
     */
    private $imagem;


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
     * Set categoria.
     *
     * @param int $categoria
     *
     * @return Produtos
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria.
     *
     * @return int
     */
    public function getCategoria()
    {
        return $this->categoria;
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
     * Set situacao.
     *
     * @param string $situacao
     *
     * @return Produtos
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
     * @return Produtos
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
     * Set imagem.
     *
     * @param \Arquivos|null $imagem
     *
     * @return Produtos
     */
    public function setImagem(\Arquivos $imagem = null)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem.
     *
     * @return \Arquivos|null
     */
    public function getImagem()
    {
        return $this->imagem;
    }
}
