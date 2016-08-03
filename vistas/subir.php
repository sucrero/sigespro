<?php
    require '../clases/Subarchivos.php';
    $sub = new Subarchivos();
    $sub->setPath($_SERVER['DOCUMENT_ROOT']."/archivos");
    $sub->setFile("archivo");
    $sub->save();
    echo $sub->message;

