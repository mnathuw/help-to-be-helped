<?php


  define('ADMIN_LOGIN','nmai63');

  define('ADMIN_PASSWORD','123456');


  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])

      || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)

      || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {

    header('HTTP/1.1 401 Unauthorized');

    header('WWW-Authenticate: Basic realm="Help to be helped"');

    exit("Access Denied: Username and password required.");

  }

   

?>