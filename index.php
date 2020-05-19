<?php

    require_once("config.php");

    //Carrega um usuário
    //$root = new Usuario();
    //$root->loadbyCod(1);
    //echo $root;

    //Carrega uma lista de usuários
    //$lista = Usuario::getList();
    //echo json_encode($lista);

    //Carrega uma lista apartir da categoria
    //$search = Usuario::search("ac");
    //echo json_encode($search);

    //Carrega por grupo e subgrupo
    $usuario = new Usuario();
    $usuario->searchCadastro("ROUPA", "MASCULINA");

    echo $usuario;

?>