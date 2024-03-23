<?php

namespace Mvc\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Mvc\Models\Users;
use Mvc\Controllers\Engine\EnginePlates;

/**
 *
 */
class UsersController
{
  public function register(Request $request, Response $response)
  {
    $data = ['title' => WEB_TITLE . " - Register"];

    $response->getBody()->write(
      EnginePlates::view('register', $data)
    );

    return $response;
  }

  public function register_store(Request $request, Response $response)
  {
    // obter os dados do formulario
    $dadosForm = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

    // validar o dados enviados
    if (in_array('', $dadosForm)) {
      $response->getBody()->write('<p>dados invalidos para registrar usuário</p>');
      return $response;
    }

    // persistir no banco de dados
    $user = new Users();
    $user->register(
      ['usuarios', 'enderecos', 'telefones'],
      $dadosForm
    );

    if (!$user->success && $user->exception) {
      $message = "<p>dados invalidos para registrar usuário</p>";

      if (str_contains($user->exception->getMessage(), "email")) {

        $message = "<p>Email {$dadosForm['cnEmail']} já esta sendo usado!!!</p>";
      } elseif (str_contains($user->exception->getMessage(), "login")) {

        $message = "<p>Usuario {$dadosForm['cnNickname']} já esta sendo usado!!!</p>";
      }
      $response->getBody()->write($message);
      return $response;
    }

    reset($_POST);
    reset($dadosForm);

    $data = ['title' => WEB_TITLE . " - Register", 'message' => 'Usuario Registrado com sucesso'];

    $response->getBody()->write(
      EnginePlates::view('register', $data)
    );

    return $response;
  }

  public function visualizar(Request $request, Response $response)
  {

    $data['title'] = WEB_TITLE . " - Visualizar";
    $user = new Users();
    $data['usuarios'] = $user->All();

    $response->getBody()->write(
      EnginePlates::view('visualizar', $data)
    );

    return $response;
  }

  /**
   * @return Response $response
   */
  public function user_perfil(Request $request, Response $response, array $args)
  {
    $userId = (int) $_GET['id'];

    $response->getBody()->write(
      EnginePlates::view('meu_perfil')
    );

    return $response;
  }

  public function login(Request $request, Response $response)
  {
    // obter os dados do POST - Formulario
    // validar esses dados
    // buscar no banco de dados na tabela de usuario pelo email do user
    // usar a função do php para checar a hash da senha do usuario
    // criar a sessão para esse usuario 
    // redirecionar o usuario para o dashboad
    // emitir uma mensagem de erro para o usuario

    return $response;
  }
}
