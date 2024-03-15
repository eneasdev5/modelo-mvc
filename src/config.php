<?php

define("URI_BASE", 'http://127.0.0.1:8003');
define('WEB_TITLE', 'Gestor de Usuários');

define('ENPOINTS', array(
  'page_home' => '/',
  'page_register' => '/register-users',
  'page_visualizar' => [
    '/visualizar',
    '/user-perfil'
  ],
));

/*
ENPOINTS['page_home']
ENPOINTS['page_register']
ENPOINTS['page_visualizar'][0]
ENPOINTS['page_visualizar'][1]
*/
