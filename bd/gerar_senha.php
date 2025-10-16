<?php
  // A senha que você quer usar
  $senhaEmTextoPuro = '123456';

  // Gera o hash usando o algoritmo padrão e seguro do PHP
  $hashDaSenha = password_hash($senhaEmTextoPuro, PASSWORD_DEFAULT);

  // Imprime o hash na tela para você poder copiar
  echo $hashDaSenha;
?>