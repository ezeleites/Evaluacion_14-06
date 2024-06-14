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

function buscarPorModelo($productos, $modelo){
    foreach ($productos as $producto){
        if($producto['modelo'] == $modelo){
            return "Nombre: ".$producto['nombre']."<br>"; 
        }
    }
    return "Producto no encotrado";
}