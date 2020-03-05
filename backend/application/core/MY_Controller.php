<?php

class MY_Controller extends CI_Controller {

    function dump(string $type, $message): void
    {
        if (DUMP) {
            switch($type) {
                case 'info':
                    $color = "0;36m";
                break;
                case 'error':
                    $color = "0;31m";
                break;
                default:
                    $color = "0;32m";
                    $type = "debug";
                break;
            }
            // log_message($type, sprintf("\e[{$color}%s\e[0m", $message . "\n Linha: " . __LINE__ . " em " . (!empty($this->uri->uri_string()) ? $this->uri->uri_string() : "/") . "."));
        }
    }

    function death(string $message): void
    {
        $this->dump('error', $message);
        exit($message);
    }

    function setReturn(bool $success, string $message, array $data = []): array
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data];
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
                        $this->dump('info', 'JSON: Retornou falso, porém não ocorreu nenhum erro.');
                    } else {
                        $this->dump('info', 'JSON: ' . $lastError . '.');
                    }
                }
            }
        }
        return $value;
    }

    function setSubmit(bool $success, string $message, array $data = []): string
    {
        return $this->setJson($this->setReturn($success, $message, $data));
    }

}
