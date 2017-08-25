<?php
/**
 * Created by PhpStorm.
 * User: dcandrade
 * Date: 4/1/16
 * Time: 1:29 AM
 */


$mail = mail( "dca650@gmail.com", "Doa Ação - Contato de ".$_GET["nome"], $_GET["mensagem"], $_GET["email"]);

if($mail){
    echo "Thank you for using our mail form";
}else{
    echo "Mail sending failed.";
}

?>