<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Opcionais
 *
 * @Table(name="opcionais", indexes={@Index(name="fk_opcionais_opcao_idx", columns={"opcao"})})
 * @Entity
 */
class Opcionais
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
     * @var float|null
     *
     * @Column(name="valor", type="float", precision=10, scale=0, nullable=true)
     */
    private $valor = '0';

    /**
     * @var int
     *
     * @Column(name="opcao", type="integer", nullable=false)
     */
    private $opcao;

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
     * @return Opcionais
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
     * Set valor.
     *
     * @param float|null $valor
     *
     * @return Opcionais
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
     * Set opcao.
     *
     * @param int $opcao
     *
     * @return Opcionais
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
     * @param string $situacao
     *
     * @return Opcionais
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
     * @return Opcionais
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
}
