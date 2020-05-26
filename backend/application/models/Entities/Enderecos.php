<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enderecos
 *
 * @Table(name="enderecos", indexes={@Index(name="fk_endereco_bairro_idx", columns={"bairro"}), @Index(name="fk_endereco_cliente_idx", columns={"cliente"})})
 * @Entity
 */
class Enderecos
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
     * @Column(name="endereco", type="string", length=255, nullable=false)
     */
    private $endereco;

    /**
     * @var string
     *
     * @Column(name="complemento", type="string", length=255, nullable=false)
     */
    private $complemento;

    /**
     * @var int
     *
     * @Column(name="bairro", type="integer", nullable=false)
     */
    private $bairro;

    /**
     * @var int
     *
     * @Column(name="cliente", type="integer", nullable=false)
     */
    private $cliente;

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
     * Set endereco.
     *
     * @param string $endereco
     *
     * @return Enderecos
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco.
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set complemento.
     *
     * @param string $complemento
     *
     * @return Enderecos
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;

        return $this;
    }

    /**
     * Get complemento.
     *
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Set bairro.
     *
     * @param int $bairro
     *
     * @return Enderecos
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro.
     *
     * @return int
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set cliente.
     *
     * @param int $cliente
     *
     * @return Enderecos
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente.
     *
     * @return int
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Enderecos
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
     * @return Enderecos
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
