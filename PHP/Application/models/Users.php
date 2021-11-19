<?php

namespace Application\models;

use Application\core\Database;
use PDO;
class Users
{
  /** Poderiamos ter atributos aqui */

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

  public function findUserByEmailOrUsername($email, $username){
    $result = $conn->executeQuery('SELECT * FROM usuario WHERE username = :username OR email = :email', array(
      ':username' => $username,
      ':email' => $email,
    ));
    // $this->db->query('SELECT * FROM users WHERE usersUid = :username OR usersEmail = :email');
    // $this->db->bind(':username', $username);
    // $this->db->bind(':email', $email);

    // $row = $this->db->single();

    //Check row
    if($result->rowCount() > 0){
        return true;
    }else{
        return false;
    }
    }

  //Register User
  public function register($data){
    $conn = new Database();
    $result = $conn->executeQuery('INSERT INTO usuario (username, email, nome, senha, foto_perfil) VALUES (:username, :email, :nome, :senha, :foto_perfil)', array(
      ':username'       => $data['username'],
      ':email'          => $data['email'],
      ':nome'           => $data['nome'],
      ':senha'          => $data['senha'],
      ':foto_perfil'    => $data['foto_perfil']
    ));
  }

  //Login user
  public function login($nameOrEmail, $password){
    $row = $this->findUserByEmailOrUsername($nameOrEmail, $nameOrEmail);

    if($row == false) return false;

    $hashedPassword = $row->usersPwd;
    if(password_verify($password, $hashedPassword)){
        return $row;
    }else{
        return false;
    }
  }

}
