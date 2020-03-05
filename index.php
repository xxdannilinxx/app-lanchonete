<?php

/**
 * BANCO DE DADOS
 */
// mudar para preg_split
// $base = explode("\n", trim(file_get_contents(BASE_ROOT . '/database')));
//         $basedir_db = (!empty($base[1]) ? $base[1] : '');
//         $base = explode(",", trim($base[0]));

//         $hostname_db = $base[0];

//         if (isset($base[1])) {
//             $username_db = $base[1];
//         }

//         if (isset($base[2])) {
//             $password_db = $base[2];
//         }

//         if (isset($base[3])) {
//             $database_db = $base[3];
//         }


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
 * EM PRODUÇÃO
 */
define("IN_PRODUCTION", file_exists('dev'));


require "backend/index.php";
