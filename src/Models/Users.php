<?php

namespace Mvc\Models;

use PDOException;
use League\Plates\Engine;

/**
 *
 */
class Users
{
  private $connect;
  public $success;
  public $exception;

  public function __construct()
  {
    $this->connect = MysqlRepository::getConnect(
      '127.0.0.1',
      'root',
      '',
      'crud'
    );
    $this->success = false;
    $this->exception = null;
  }
  /*
      array (size=12)
      'cnNome' => string '&#60;h1&#62;hacker&#60;/h1&#62;' (length=31)
      'cnEmail' => string '' (length=0)
      'cnNickname' => string '' (length=0)
      'cnPassword' => string '' (length=0)
      'cnCep' => string '' (length=0)
      'cnRua' => string '' (length=0)
      'cnNumero_residencial' => string '' (length=0)
      'cnComplemento' => string '' (length=0)
      'cnBairro' => string '' (length=0)
      'cnCidade' => string '' (length=0)
      'cnEstado' => string '' (length=0)
      'cnTelefone' =>
        array (size=1)
          0 => string '' (length=0)
    */

  public function getUserByCredencias(array $credencias)
  {
    $result = [];
    $query = "SELECT * FROM usuarios WHERE nickname=:nick";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(':nick', $credencias['nickname']);
    $res =  $stmt->execute();
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    var_dump($result);
  }

  public function insertUser(array $dadosForm)
  {
    try {
      $query = "INSERT INTO usuarios (nome, email, nickname, senha) VALUES(:nome, :email, :nickname,:senha)";
      $stmt = $this->connect->prepare($query);
      $stmt->bindParam(':nome', $dadosForm['cnNome']);
      $stmt->bindParam(':nickname', $dadosForm['cnNickname']);
      $stmt->bindParam(':email', $dadosForm['cnEmail']);
      $stmt->bindParam(':senha', password_hash($dadosForm['cnPassword'], PASSWORD_DEFAULT));
      $this->success = $stmt->execute();
      return $this->connect->lastInsertId(); // obtem o id do usuario inserido
    } catch (PDOException $th) {
      return new PDOException($th);
    }
  }
  public function register(array $table, array $dadosForm)
  {

    $lastInsertIDUser = $this->insertUser($dadosForm);
    if ($lastInsertIDUser instanceof PDOException) {
      $this->exception = $lastInsertIDUser;
      $this->success = false;
      return;
    }

    // insert table endereco
    $query = "INSERT INTO {$table[1]} (id,cep, rua, numero, complemento, bairro, cidade, estado,usuario_id) VALUES (default, :cep, :rua, :numero, :complemento, :bairro, :cidade, :estado,:usuario_id)";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(':cep', $dadosForm['cnCep']);
    $stmt->bindParam(':rua', $dadosForm['cnRua']);
    $stmt->bindParam(':numero', $dadosForm['cnNumero_residencial']);
    $stmt->bindParam(':complemento', $dadosForm['cnComplemento']);
    $stmt->bindParam(':bairro', $dadosForm['cnBairro']);
    $stmt->bindParam(':cidade', $dadosForm['cnCidade']);
    $stmt->bindParam(':estado', $dadosForm['cnEstado']);
    $stmt->bindParam(':usuario_id', $lastInsertIDUser);
    $this->success = $stmt->execute();

    // insert table telefone
    $query = "INSERT INTO {$table[2]} (numero_telefone, usuario_id) VALUES (:numero_telefone, :usuario_id)";
    $stmt = $this->connect->prepare($query);
    foreach ($dadosForm['cnTelefone'] as $value) {
      $stmt->bindParam(':numero_telefone', $value);
      $stmt->bindParam(':usuario_id', $lastInsertIDUser);
      $this->success = $stmt->execute();
    }
  }

  public function All()
  {
    $users = array();
    $query = "SELECT * FROM usuarios";
    $stmt = $this->connect->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $users;
  }

  public function getById(int $userID)
  {
    $query = "SELECT * FROM usuarios WHERE id=:id";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(":id", $userID);
    $stmt->execute();
    return  $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function getUsersByJoins(int $userID)
  {
    $query = "SELECT u.id, u.nome,u.email, u.nickname, t.numero_telefone, e.cep, e.rua,e.numero, e.complemento, e.bairro, e.cidade, e.estado FROM usuarios u INNER JOIN telefones t ON t.usuario_id=u.id INNER JOIN enderecos e ON e.usuario_id=u.id WHERE u.id = 1;";
    $stmt = $this->connect->prepare($query);
    $stmt->bindParam(':id', $userID);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}
