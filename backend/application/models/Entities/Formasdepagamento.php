<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formasdepagamento
 *
 * @Table(name="formasDePagamento")
 * @Entity
 */
class Formasdepagamento
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
     * @var string|null
     *
     * @Column(name="descricao", type="string", length=45, nullable=true)
     */
    private $descricao;

    /**
     * @var int
     *
     * @Column(name="troco", type="integer", nullable=false)
     */
    private $troco = '0';

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
     * Set nome.
     *
     * @param string $nome
     *
     * @return Formasdepagamento
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
     * @param string|null $descricao
     *
     * @return Formasdepagamento
     */
    public function setDescricao($descricao = null)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao.
     *
     * @return string|null
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set troco.
     *
     * @param int $troco
     *
     * @return Formasdepagamento
     */
    public function setTroco($troco)
    {
        $this->troco = $troco;

        return $this;
    }

    /**
     * Get troco.
     *
     * @return int
     */
    public function getTroco()
    {
        return $this->troco;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Formasdepagamento
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
     * @return Formasdepagamento
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
