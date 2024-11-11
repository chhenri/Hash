<?php
//Senha em texto simples 
$senhaTexto = "admin";
//Gerar o hash da senha 
//bycript
$senhaHash = password_hash($senhaTexto, PASSWORD_DEFAULT);
//exibir hash gerado
echo "Hash da senha:" . $senhaHash;
?>