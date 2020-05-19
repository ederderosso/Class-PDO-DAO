<?php

    require_once("config.php");

    $root = new Usuario();

    $root->loadbyCod(1);

    echo $root;

    // $sql = new SqL();

    // $usuarios = $sql->select("SELECT * FROM categorias");

    // echo json_encode($usuarios);

?>