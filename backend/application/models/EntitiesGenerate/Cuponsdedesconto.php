<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Cuponsdedesconto
 *
 * @Table(name="cuponsDeDesconto")
 * @Entity
 */
class Cuponsdedesconto
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
     * @var string
     *
     * @Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var float|null
     *
     * @Column(name="porcentagem", type="float", precision=10, scale=0, nullable=true)
     */
    private $porcentagem = '0';

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
}
