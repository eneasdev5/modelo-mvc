<?php

namespace Mvc\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Mvc\Controllers\Engine\EnginePlates;

class HomeController
{
  public function home(Request $request, Response $response)
  {
    $data = ['title' =>  WEB_TITLE . ' - Home'];

    $response->getBody()->write(
      EnginePlates::view('home', $data)
    );

    return $response;
  }
}
