<?php

    require_once("config.php");

    $sql = new SqL();

    $usuarios = $sql->select("SELECT * FROM clientes");

    echo json_encode($usuarios);

?>