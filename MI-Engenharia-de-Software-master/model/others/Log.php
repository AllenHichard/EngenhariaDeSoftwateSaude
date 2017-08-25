<?php
/**
 * Created by PhpStorm.
 * User: Allen, Ana Jaíze, André, Antônio, Daniel, Wanderson
 * Date: 3/6/16
 * Time: 11:42 PM
 */
/**
* Função para salvar mensagens de LOG no MySQL
*
* @param string $mensagem - A mensagem a ser salva
*
* @return bool - Se a mensagem foi salva ou não (true/false)
*/
function salvaLog($mensagem) {
$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)

$mensagem = mysql_escape_string($mensagem);
//  inserir o log no sistema
$sql = "INSERT INTO `logs` VALUES (NULL, '".$hora."', '".$ip."', '".$mensagem."')";
if (mysql_query($sql)) {
return true;
} else {
return false;
}
}