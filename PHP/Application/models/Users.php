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

  public static function suggestionUser()
  {
    $conn = new Database();

    $id = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT id_usuario, nome, username, foto_perfil FROM usuario WHERE id_usuario <> :ID LIMIT 5', array(
      ':ID' => $id
    ));
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

  public function bot($mensagem){
    $conn = mysqli_connect("localhost", "virtuarteuser", "virtuartepassword", "virtuarte") or die("Database Error");

    // getting user message through ajax
    $getMesg = mysqli_real_escape_string($conn, $mensagem);

    //checking user query to database query
    $check_data = "SELECT nome FROM usuario WHERE email LIKE '%$getMesg%'";
    $run_query = mysqli_query($conn, $check_data) or die("Error");

    // if user query matched to database query we'll show the reply otherwise it go to else statement
    if(mysqli_num_rows($run_query) > 0){
        //fetching replay from the database according to the user query
        $fetch_data = mysqli_fetch_assoc($run_query);
        //storing replay to a varible which we'll send to ajax
        // $replay = $fetch_data['nome'];
        $retorno = $fetch_data['nome'];
        // echo $replay;
    }else{
        // echo "Sorry can't be able to understand you!";
        $retorno = "Sorry can't be able to understand you!";
    }

    return $retorno;
  }

  // new post
  public function newPost($legend, $midia){
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO publicacao (legenda, midia, fk_usuario_id_usuario) VALUES (:legenda, :midia, :user)');
    // bind values
    $conn->bind(':legenda', $legend);
    $conn->bind(':midia', $midia);
    $conn->bind(':user', $user);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  // my own posts
  public static function findPostsById(int $id)
  {
    $conn = new Database();
    $result = $conn->executeQuery('SELECT id_publicacao, midia, legenda, data_publicacao FROM publicacao WHERE fk_usuario_id_usuario = :ID', array(
      ':ID' => $id
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  // my own posts
  public static function findAllPosts()
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT post.id_publicacao, post.midia, post.legenda, post.data_publicacao, post.fk_usuario_id_usuario, perfil.foto_perfil, perfil.nome, perfil.id_usuario
    FROM publicacao post
    LEFT JOIN segue
    ON post.fk_usuario_id_usuario = segue.fk_usuario_id_usuario_
    LEFT JOIN usuario perfil
    ON post.fk_usuario_id_usuario = perfil.id_usuario
    WHERE segue.fk_usuario_id_usuario = :ID
    OR post.fk_usuario_id_usuario = :ID
    ORDER BY post.data_publicacao DESC', array(
      ':ID' => $user
    ));

    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  // follow
  public function follow($id){
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO segue (fk_usuario_id_usuario, fk_usuario_id_usuario_) VALUES (:followerId, :followingId)');
    // bind values
    $conn->bind(':followerId', $user);
    $conn->bind(':followingId', $id);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  // unfollow
  public function unfollow($id){
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('DELETE FROM segue WHERE fk_usuario_id_usuario = :followerId AND fk_usuario_id_usuario_ = :followingId');
    // bind values
    $conn->bind(':followerId', $user);
    $conn->bind(':followingId', $id);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  // following
  public static function following()
  {
    $conn = new Database();

    $id = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT id_usuario, nome, username
    FROM usuario
    RIGHT JOIN segue
    ON fk_usuario_id_usuario_ = id_usuario
    WHERE fk_usuario_id_usuario = :ID', array(
      ':ID' => $id
    ));
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function toLike($id){
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO curte (fk_usuario_id_usuario, fk_publicacao_id_publicacao, curtir) VALUES (:user, :post, :toLike)');
    // bind values
    $conn->bind(':user', $user);
    $conn->bind(':post', $id);
    $conn->bind(':toLike', 1);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  public function notLike($id){
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('UPDATE curte SET curtir = :notLike WHERE fk_usuario_id_usuario = :user AND fk_publicacao_id_publicacao = :post');
    // bind values
    $conn->bind(':user', $user);
    $conn->bind(':post', $id);
    $conn->bind(':toLike', 0);

    // execute
    if($conn->execute()){
      return true;
    }
    else{
      return false;
    }
  }

  public static function liked(){
    $conn = new Database();

    $id = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT id_publicacao, fk_usuario_id_usuario 
    FROM publicacao
    RIGHT JOIN curte
    ON id_publicacao = fk_publicacao_id_publicao 
    WHERE curtir = :ID', array(
      ':ID' => $id
    ));
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }
}