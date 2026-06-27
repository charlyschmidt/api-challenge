<?php

require 'conexion.php';

function listarProductos()
{
    global $pdo;

    $productos = $pdo->query("SELECT * FROM productos");
    return $productos->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerProducto($id)
{
    global $pdo;

    $productos = $pdo->prepare("SELECT * FROM productos WHERE id=?");
    $productos->execute([$id]);

    return $productos->fetch(PDO::FETCH_ASSOC);
}

function crearProducto($nombre,$descripcion,$precio)
{
    global $pdo;

    $productos = $pdo->prepare("INSERT INTO productos(nombre,descripcion,precio) VALUES(?,?,?)");

    return $productos->execute([$nombre,$descripcion,$precio]);
}

function actualizarProducto($id, $nombre, $descripcion, $precio)
{
    global $pdo;
    $actualizar = $pdo->prepare("UPDATE productos SET nombre=?,descripcion=?,precio=? WHERE id=?");

    $actualizar->execute([$nombre, $descripcion, $precio, $id]);

    return $actualizar->rowCount() > 0;
}

function borrarProducto($id)
{
    global $pdo;

    $borrar = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $borrar->execute([$id]);

    return $borrar->rowCount() > 0;
}