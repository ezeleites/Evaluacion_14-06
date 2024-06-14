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

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

$productos = $_SESSION['productos'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';
    $valor = $_POST['valor'] ?? '';
    $modelo = $_POST['modelo'] ?? '';

    switch ($accion) {
        case 'agregar':
            $productos = agregarProductos($productos,$nombre,$cantidad,$valor,$modelo);
            $resultado = "Producto agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarPorModelo($productos,$modelo);
            break;
        
        case 'mostrar':
            $resultado = mostrarProductos($productos);
            break;
        
        case 'actualizar':
            $productos = actualizarProducto($productos,$nombre,$cantidad,$valor,$modelo);
            $resultado = "Prodcuto actualizado correctamente.<br>";
            break;

        case 'limpiar':
            $_SESSION['productos'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        case 'valortotal':
            $resultado = calcularValor($productos, $valor, $cantidad);
            break;

        case 'listar':
            $resultado = listarModelos($productos, $modelo);
            break;

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['productos'] = $productos;
    $_SESSION['resultado'] = $resultado;
}

header("Location: formularioEvaluacion.php");
exit();
?>