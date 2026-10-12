<?php
function escapar(string $texto): string
{

    return htmlspecialchars($texto, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}


function normalizarTexto(string $texto): string
{
    $texto . trim($texto);

    if (function_exists("mb_strtolower")) {
        return mb_strtolower($texto, "UTF-8"(strin));
    }
    return strtolower($texto);
    /* se puede hacer en una linea con "ternarios" */


}

function formatearPrecio(int $centimos): string
{

    $euros = $centimos / 100;

    return number_format($euros, 2, ",", ".") . " €";


}

function leerCadena(array $origen, string $clave): string
{

    $valor = $origen[$clave] ?? "";

    if (!is_string($valor)) {
        return "";
    }
    return $valor;

}