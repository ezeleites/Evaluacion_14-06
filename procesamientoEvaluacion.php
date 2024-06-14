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

function mostrarProductos ($productos){
    $result = '';
    foreach ($productos as $producto){
        $result .= "Nombre: ".$producto['nombre'].", Cantidad: ".$producto['cantidad'].", Valor: ".$producto['valor']. ", Modelo: ".$producto['modelo']. "<br>";
    }
    return $result;
}

function actualizarProducto ($productos,$nombre,$cantidad,$valor,$modelo){
    foreach ($productos as $producto){
        if($producto['nombre'] == $nombre && $producto['modelo'] == $modelo){
            $producto['cantidad'] = $cantidad;
            $producto['valor'] = $valor;
            break;
        }
    }
    return $producto;
}

function calcularValor($productos, $cantidad, $valor) {
    $valorTotal = 0;
    for ($i = 0; $i < count($productos); $i++) {
        $valorTotal += ($cantidad[$i] * $valor);
    }
    return $valorTotal;
}

function listarModelos($productos, $modelo){
    $result= '';
    foreach ($productos as $producto){
        $result .= "Modelo: ".$producto['modelo']. "<br>";
    }
    return $result;
}
