<?php 
session_start();

function agregarProductos($productos,$nombre,$cantidad,$valor,$modelo){
    $productos[] = [
        'nombre' => $nombre,
        'cantidad' => $cantidad,
        'valor' => $valor,
        'modelo' => $modelo
    ];
    return $productos;
}