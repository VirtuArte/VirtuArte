<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{
  /** Poderiamos ter atributos aqui */
  private $db;
  
  public function __construct(){
    $this->db = new Database;
  }

  /**
  * Este método busca todos os usuários armazenados na base de dados
  *
  * @return   array
  */
  public static function findAll()
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuario');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
  * Este método busca um usuário armazenados na base de dados com um
  * determinado ID
  * @param    int     $id   Identificador único do usuário
  *
  * @return   array
  */
  public static function findById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT * FROM usuario WHERE id_usuario = :ID LIMIT 1', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  //Find user by email or username
  public function findUserByEmailOrUsername($email, $username){
    $conn = new Database();

    $conn->query('SELECT * FROM usuario WHERE username = :username OR email = :email');
    $conn->bind(':username', $username);
    $conn->bind(':email', $email);

    $row = $conn->single();

    // Check row
    if($conn->rowCount() > 0){
        return $row;
    }else{
        return false;
    }
  }

  //Register User
  public function register($data){
    $conn = new Database();

    $conn->query('INSERT INTO usuario (username, email, nome, senha) VALUES (:username, :email, :nome, :senha)');
    // bind values
    $conn->bind(':username', $data['username']);
    $conn->bind(':email', $data['email']);
    $conn->bind(':nome', $data['nome']);
    $conn->bind(':senha', $data['senha']);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }
  
  public function login($nameOrEmail, $password, $row){
    if($row == false) return false;

    $hashedPassword = $row->senha;
    if(password_verify($password, $hashedPassword)){
        return $row;
    }else{
        return false;
    }
  }

}
