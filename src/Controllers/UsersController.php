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
    // var_dump(filter_var($_POST['cnNome'], FILTER_SANITIZE_SPECIAL_CHARS));
    // var_dump(htmlspecialchars($_POST['cnNome']));


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
}
