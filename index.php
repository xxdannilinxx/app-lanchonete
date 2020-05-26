<?php
header('Accept: application/json');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept');
date_default_timezone_set('America/Sao_Paulo');

/**
 * BANCO DE DADOS
 */
if (!file_exists('db')) {
    exit("É necessário que seja criado o arquivo db na raíz.");
}
$base = preg_split("/,/", file_get_contents('db'));
define("DB_HOST", (isset($base[0]) ? $base[0] : ""));
define("DB_USER", (isset($base[1]) ? $base[1] : ""));
define("DB_PASS", (isset($base[2]) ? $base[2] : ""));
define("DB_NAME", (isset($base[3]) ? $base[3] : ""));

/**
 * DUMP
 */
if (file_exists('dump')) {
    $dump = (int) file_get_contents('dump');
    if ($dump <= 0) {
        file_put_contents('dump', 1);
    }
    define("DUMP", $dump);
} else {
    define("DUMP", false);
}

/**
 * SITUAÇÃO
 */
if (file_exists('manutencao')) {
    exit('Estamos em manutenção no momento.');
}

/**
 * EM PRODUÇÃO
 */
define("IN_PRODUCTION", file_exists('dev'));

require "backend/index.php";
