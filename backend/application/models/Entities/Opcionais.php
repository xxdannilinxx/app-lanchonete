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
     * @var \Entities\Opcoes
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
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Opcionais
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
     * @return Opcionais
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
     * @param \Entities\Opcoes|null $opcao
     *
     * @return Opcionais
     */
    public function setOpcao(\Entities\Opcoes $opcao = null)
    {
        $this->opcao = $opcao;

        return $this;
    }

    /**
     * Get opcao.
     *
     * @return \Entities\Opcoes|null
     */
    public function getOpcao()
    {
        return $this->opcao;
    }
}
