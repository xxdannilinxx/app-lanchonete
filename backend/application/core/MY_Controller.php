<?php

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        debug('Requisição realizada por: ' . $_SERVER['REMOTE_ADDR']);
    }

    public function death(string $message): void
    {
        error($message);
        exit($message);
    }

    public function __call(string $name, array $arguments): void
    {
        $classe = get_class($this);
        $message = "Sua requisição não existe ou foi descontinuado: {$classe}::{$name}.";
        $this->death($message);
    }

    public function getException($exception, bool $return = false): bool
    {
        error($exception->getMessage() . "\n" . $exception->getTraceAsString(), E_CORE_ERROR);
        return $return;
    }

    public function setReturn(bool $success, string $message, array $data = []): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data
        ];
    }

    public function setJson(array $value, int $options = 0, bool $errorGenerateException = false): string
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

    public function setSubmit(bool $success, string $message, array $data = []): void
    {
        header("Content-type: application/json; charset=utf-8");
        echo $this->setJson($this->setReturn($success, $message, $data));
    }
}
