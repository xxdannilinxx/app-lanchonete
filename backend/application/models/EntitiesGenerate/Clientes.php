<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @Table(name="clientes", uniqueConstraints={@UniqueConstraint(name="email_UNIQUE", columns={"email"}), @UniqueConstraint(name="facebook_uid_UNIQUE", columns={"facebook"}), @UniqueConstraint(name="telefone_UNIQUE", columns={"telefone"}), @UniqueConstraint(name="token_UNIQUE", columns={"token"})})
 * @Entity
 */
class Clientes
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
     * @Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @Column(name="telefone", type="string", length=45, nullable=true)
     */
    private $telefone;

    /**
     * @var string
     *
     * @Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string|null
     *
     * @Column(name="cpf", type="string", length=45, nullable=true)
     */
    private $cpf;

    /**
     * @var string|null
     *
     * @Column(name="facebook", type="string", length=100, nullable=true)
     */
    private $facebook;

    /**
     * @var int
     *
     * @Column(name="nivel", type="integer", nullable=false)
     */
    private $nivel = '0';

    /**
     * @var string
     *
     * @Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;

    /**
     * @var json|null
     *
     * @Column(name="configuracoes", type="json", nullable=true)
     */
    private $configuracoes;

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
     * Set email.
     *
     * @param string $email
     *
     * @return Clientes
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
     * @param string|null $telefone
     *
     * @return Clientes
     */
    public function setTelefone($telefone = null)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return string|null
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set nome.
     *
     * @param string $nome
     *
     * @return Clientes
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
     * Set cpf.
     *
     * @param string|null $cpf
     *
     * @return Clientes
     */
    public function setCpf($cpf = null)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Get cpf.
     *
     * @return string|null
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set facebook.
     *
     * @param string|null $facebook
     *
     * @return Clientes
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook.
     *
     * @return string|null
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set nivel.
     *
     * @param int $nivel
     *
     * @return Clientes
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel.
     *
     * @return int
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set token.
     *
     * @param string $token
     *
     * @return Clientes
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set configuracoes.
     *
     * @param json|null $configuracoes
     *
     * @return Clientes
     */
    public function setConfiguracoes($configuracoes = null)
    {
        $this->configuracoes = $configuracoes;

        return $this;
    }

    /**
     * Get configuracoes.
     *
     * @return json|null
     */
    public function getConfiguracoes()
    {
        return $this->configuracoes;
    }

    /**
     * Set situacao.
     *
     * @param string|null $situacao
     *
     * @return Clientes
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
     * @return Clientes
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
