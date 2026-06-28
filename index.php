<?php

require 'productos.php';

header('Content-Type: application/json');

$env = parse_ini_file(".env");

$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

$metodo = $_SERVER['REQUEST_METHOD'];

switch($metodo) {
    case "GET":

         if (count($uri) == 1) {

            // GET /productos
            $productos = listarProductos();

            foreach ($productos as &$producto) {
                $producto["precio_usd"] = round($producto["precio"] / $env["PRECIO_USD"],2);
            }

            echo json_encode($productos);

        } elseif (count($uri) == 2) {

            // GET /productos/1
            $producto = obtenerProducto($uri[1]);

            if (!$producto) {
                http_response_code(404);
                echo json_encode(["mensaje" => "Producto no encontrado"]);
                exit;
            }

            $producto["precio_usd"] = round($producto["precio"] / $env["PRECIO_USD"],2);

            echo json_encode($producto);

        }

        break;
    
    case "POST":
     $data = json_decode(file_get_contents("php://input"),true);

        crearProducto($data["nombre"],$data["descripcion"],$data["precio"]);

        echo json_encode(["mensaje"=>"Producto creado"]);
    break;

    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);

        actualizarProducto($data['id'],$data["nombre"],$data["descripcion"],$data["precio"]);

        echo json_encode(["mensaje" => "Producto actualizado"]);
    break;

    case "DELETE":

        $data = json_decode(file_get_contents("php://input"),true);

        borrarProducto($uri[0]);

        echo json_encode(["mensaje"=>"Producto borrado"]);
    break;

    default:

        http_response_code(405);
        echo json_encode(["mensaje" => "Método no permitido"]);
}