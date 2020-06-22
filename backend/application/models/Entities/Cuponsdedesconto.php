<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cuponsdedesconto
 *
 * @Table(name="cuponsDeDesconto", indexes={@Index(name="fk_cupom_bairro_idx", columns={"bairro"}), @Index(name="fk_cupom_forma_pagamento_idx", columns={"formaDePagamento"})})
 * @Entity
 */
class Cuponsdedesconto
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
    private $nome = '0';

    /**
     * @var \DateTime
     *
     * @Column(name="dataInicio", type="datetime", nullable=false)
     */
    private $datainicio;

    /**
     * @var \DateTime
     *
     * @Column(name="dataTermino", type="datetime", nullable=false)
     */
    private $datatermino;

    /**
     * @var int|null
     *
     * @Column(name="quantidadeMinima", type="integer", nullable=true)
     */
    private $quantidademinima = '0';

    /**
     * @var float|null
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=true)
     */
    private $valor = '0';

    /**
     * @var float|null
     *
     * @Column(name="porcentagem", type="float", precision=10, scale=0, nullable=true)
     */
    private $porcentagem = '0';

    /**
     * @var int
     *
     * @Column(name="reuso", type="integer", nullable=false)
     */
    private $reuso = '0';

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
     * @var \Bairros
     *
     * @ManyToOne(targetEntity="Bairros")
     * @JoinColumns({
     *   @JoinColumn(name="bairro", referencedColumnName="id")
     * })
     */
    private $bairro;

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
     * Set nome.
     *
     * @param string $nome
     *
     * @return Cuponsdedesconto
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
     * Set datainicio.
     *
     * @param \DateTime $datainicio
     *
     * @return Cuponsdedesconto
     */
    public function setDatainicio($datainicio)
    {
        $this->datainicio = $datainicio;

        return $this;
    }

    /**
     * Get datainicio.
     *
     * @return \DateTime
     */
    public function getDatainicio()
    {
        return $this->datainicio;
    }

    /**
     * Set datatermino.
     *
     * @param \DateTime $datatermino
     *
     * @return Cuponsdedesconto
     */
    public function setDatatermino($datatermino)
    {
        $this->datatermino = $datatermino;

        return $this;
    }

    /**
     * Get datatermino.
     *
     * @return \DateTime
     */
    public function getDatatermino()
    {
        return $this->datatermino;
    }

    /**
     * Set quantidademinima.
     *
     * @param int|null $quantidademinima
     *
     * @return Cuponsdedesconto
     */
    public function setQuantidademinima($quantidademinima = null)
    {
        $this->quantidademinima = $quantidademinima;

        return $this;
    }

    /**
     * Get quantidademinima.
     *
     * @return int|null
     */
    public function getQuantidademinima()
    {
        return $this->quantidademinima;
    }

    /**
     * Set valor.
     *
     * @param float|null $valor
     *
     * @return Cuponsdedesconto
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
     * Set porcentagem.
     *
     * @param float|null $porcentagem
     *
     * @return Cuponsdedesconto
     */
    public function setPorcentagem($porcentagem = null)
    {
        $this->porcentagem = $porcentagem;

        return $this;
    }

    /**
     * Get porcentagem.
     *
     * @return float|null
     */
    public function getPorcentagem()
    {
        return $this->porcentagem;
    }

    /**
     * Set reuso.
     *
     * @param int $reuso
     *
     * @return Cuponsdedesconto
     */
    public function setReuso($reuso)
    {
        $this->reuso = $reuso;

        return $this;
    }

    /**
     * Get reuso.
     *
     * @return int
     */
    public function getReuso()
    {
        return $this->reuso;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Cuponsdedesconto
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
     * @return Cuponsdedesconto
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
     * Set bairro.
     *
     * @param \Bairros|null $bairro
     *
     * @return Cuponsdedesconto
     */
    public function setBairro(\Bairros $bairro = null)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro.
     *
     * @return \Bairros|null
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set formadepagamento.
     *
     * @param \Formasdepagamento|null $formadepagamento
     *
     * @return Cuponsdedesconto
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
