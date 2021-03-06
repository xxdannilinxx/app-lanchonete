<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracoes
 *
 * @Table(name="configuracoes")
 * @Entity
 */
class Configuracoes
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
     * @var string
     *
     * @Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @Column(name="telefone", type="string", length=45, nullable=false)
     */
    private $telefone;

    /**
     * @var string
     *
     * @Column(name="horario", type="string", length=255, nullable=false)
     */
    private $horario;

    /**
     * @var string
     *
     * @Column(name="site", type="string", length=255, nullable=false)
     */
    private $site;

    /**
     * @var string
     *
     * @Column(name="facebookUid", type="string", length=100, nullable=false)
     */
    private $facebookuid;

    /**
     * @var int|null
     *
     * @Column(name="aberto", type="integer", nullable=true)
     */
    private $aberto = '0';


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
     * @return Configuracoes
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
     * Set email.
     *
     * @param string $email
     *
     * @return Configuracoes
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefone.
     *
     * @param string $telefone
     *
     * @return Configuracoes
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set horario.
     *
     * @param string $horario
     *
     * @return Configuracoes
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario.
     *
     * @return string
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set site.
     *
     * @param string $site
     *
     * @return Configuracoes
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site.
     *
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set facebookuid.
     *
     * @param string $facebookuid
     *
     * @return Configuracoes
     */
    public function setFacebookuid($facebookuid)
    {
        $this->facebookuid = $facebookuid;

        return $this;
    }

    /**
     * Get facebookuid.
     *
     * @return string
     */
    public function getFacebookuid()
    {
        return $this->facebookuid;
    }

    /**
     * Set aberto.
     *
     * @param int|null $aberto
     *
     * @return Configuracoes
     */
    public function setAberto($aberto = null)
    {
        $this->aberto = $aberto;

        return $this;
    }

    /**
     * Get aberto.
     *
     * @return int|null
     */
    public function getAberto()
    {
        return $this->aberto;
    }
}
