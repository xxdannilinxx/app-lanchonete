<?php


class MY_Controller extends CI_Controller
{

    public $habilitarApi = false;

    public function __construct()
    {
        parent::__construct();
        debug('Requisição realizada por: ' . $_SERVER['REMOTE_ADDR']);
        debug('Fuso Horário: ' . date_default_timezone_get());
        
    }

    public function __call(string $name, array $arguments): void
    {
        $classe = get_class($this);
        $mensagem = "Sua requisição não existe ou foi descontinuada: {$classe}->{$name}.";
        error($mensagem);
        exit($this->setSubmit(false, $mensagem));
    }

    public function getException(object $exception, string $message = null): void
    {
        error($exception->getMessage() . "\n" . $exception->getTraceAsString());
        exit($this->setSubmit(false, ($message ?? $exception->getMessage())));
    }

    public function setReturn(bool $success, string $message, array $data = []): object
    {
        return (object) [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }

    public function setJson(object $value, int $options = 0, bool $errorGenerateException = false): string
    {
        $value = json_encode($value, $options);
        if ($value === false) {
            $error = json_last_error();
            if ($error) {
                switch ($error) {
                    case JSON_ERROR_NONE:
                        $lastError = false;
                        break;
                    case JSON_ERROR_DEPTH:
                        $lastError = 'A profundidade máxima da pilha foi excedida';
                        break;
                    case JSON_ERROR_STATE_MISMATCH:
                        $lastError = 'Inválido ou mal formado';
                        break;
                    case JSON_ERROR_CTRL_CHAR:
                        $lastError = 'Erro de caractere de controle, possivelmente codificado incorretamente';
                        break;
                    case JSON_ERROR_SYNTAX:
                        $lastError = 'Erro de sintaxe';
                        break;
                    case JSON_ERROR_UTF8:
                        $lastError = 'Caracteres UTF-8 malformado, possivelmente codificado incorretamente';
                        break;
                    default:
                        $lastError = 'Erro desconhecido';
                        break;
                }
            }
            if (isset($lastError)) {
                if ($errorGenerateException) {
                    throw new \Exception("JSON: " . $lastError . ".");
                } else {
                    if ($lastError === false) {
                        info('JSON: Retornou falso, porém não ocorreu nenhum erro.');
                    } else {
                        info('JSON: ' . $lastError . '.');
                    }
                }
            }
        }
        return $value;
    }

    public function setSubmit(bool $success, string $message, array $data = []): bool
    {
        header("Content-type: application/json; charset=utf-8");
        echo $this->setJson($this->setReturn($success, $message, $data));
        return $success;
    }

    public function api(string $metodo = null): string
    {
        try {
            if (empty($metodo)) {
                throw new \Exception("Método não informado.");
            }

            $this->habilitarApi = true;
            $retornoMetodo = $this->$metodo();
            return $this->setSubmit($retornoMetodo->success ?? false, $retornoMetodo->message ?? null, $retornoMetodo->data ?? []);
        } catch (\Exception $e) {
            return $this->getException($e);
        }
    }

    public function verificarApi(string $metodo): object
    {
        try {
            if (!$this->habilitarApi) {
                throw new \Exception("O acesso direto ao método não é fornecido.");
            }

            if ($_SERVER['REQUEST_METHOD'] !== $metodo) {
                throw new \Exception("Forma de requisição incorreta, utilizar {$metodo}.");
            }
            $this->habilitarApi = false;
            return $this->setReturn(true, 'Ok.');
        } catch (\Exception $e) {
            return $this->getException($e);
        }
    }
}
