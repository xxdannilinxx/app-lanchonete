<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 *
 * @Table(name="clientes", uniqueConstraints={@UniqueConstraint(name="email_UNIQUE", columns={"email"}), @UniqueConstraint(name="facebook_uid_UNIQUE", columns={"facebook"}), @UniqueConstraint(name="instagram_uid_UNIQUE", columns={"instagram"}), @UniqueConstraint(name="telefone_UNIQUE", columns={"telefone"}), @UniqueConstraint(name="token_UNIQUE", columns={"token"})}, indexes={@Index(name="fk_cliente_imagem_idx", columns={"imagem"})})
 * @Entity
 */
class Clientes
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
     * @var int|null
     *
     * @Column(name="instagram", type="integer", nullable=true)
     */
    private $instagram;

    /**
     * @var int|null
     *
     * @Column(name="facebook", type="integer", nullable=true)
     */
    private $facebook;

    /**
     * @var int|null
     *
     * @Column(name="imagem", type="integer", nullable=true)
     */
    private $imagem;

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
     * @param string $telefone
     *
     * @return Clientes
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
     * Set instagram.
     *
     * @param int|null $instagram
     *
     * @return Clientes
     */
    public function setInstagram($instagram = null)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram.
     *
     * @return int|null
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set facebook.
     *
     * @param int|null $facebook
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
     * @return int|null
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set imagem.
     *
     * @param int|null $imagem
     *
     * @return Clientes
     */
    public function setImagem($imagem = null)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem.
     *
     * @return int|null
     */
    public function getImagem()
    {
        return $this->imagem;
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
     * Set situacao.
     *
     * @param string $situacao
     *
     * @return Clientes
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
     * @return Clientes
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
