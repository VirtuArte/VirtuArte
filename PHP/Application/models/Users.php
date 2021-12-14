<?php

namespace Application\models;

use Application\core\Database;
use PDO;

class Users
{
  /** Poderiamos ter atributos aqui */
  private $db;

  public function __construct()
  {
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
  public function findUserByEmailOrUsername($email, $username)
  {
    $conn = new Database();

    $conn->query('SELECT * FROM usuario WHERE username = :username OR email = :email');
    $conn->bind(':username', $username);
    $conn->bind(':email', $email);

    $row = $conn->single();

    // Check row
    if ($conn->rowCount() > 0) {
      return $row;
    } else {
      return false;
    }
  }

  //Register User
  public function register($data)
  {
    $conn = new Database();

    $conn->query('INSERT INTO usuario (username, email, nome, senha) VALUES (:username, :email, :nome, :senha)');
    // bind values
    $conn->bind(':username', $data['username']);
    $conn->bind(':email', $data['email']);
    $conn->bind(':nome', $data['nome']);
    $conn->bind(':senha', $data['senha']);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public static function getLastProfile(){
    $conn = new Database();
    $profileId = $conn->executeQuery('SELECT id_usuario FROM `usuario` ORDER BY id_usuario DESC LIMIT 1');

    return $profileId->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function registerPersonal(array $profileId)
  {
    $conn = new Database();

    foreach($profileId as $id):
      $registerPersonal = $conn->executeQuery('INSERT INTO `pessoa_fisica` (`fk_usuario_id_usuario`) VALUES (:ID);', array(
        ':ID'    => $id['id_usuario']
      ));
    break;
    endforeach;

    return $registerPersonal->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function registerCommercial(array $profileId, $description, $value, $id_endereco)
  {
    $conn = new Database();

    foreach($profileId as $id):
      $registerPersonal = $conn->executeQuery('INSERT INTO `organizacao` (`descricao`, `valor`, `fk_usuario_id_usuario`, `fk_endereco_id_endereco`) VALUES (:descricao, :price, :ID, :endereco)', array(
        ':descricao'  => $description,
        ':price'      => $value,
        ':ID'         => $id['id_usuario'],
        ':endereco'   => $id_endereco
      ));
    break;
    endforeach;

    return $registerPersonal->fetchAll(PDO::FETCH_ASSOC);
  }

  // fluxo estado
  public static function getState($state)
  {
    $conn = new Database();

    $registerState = $conn->executeQuery('SELECT id_estado FROM estado WHERE sigla = :uf', array(
      ':uf'  => $state
    ));

    return $registerState->fetchAll(PDO::FETCH_ASSOC);
  }

  // fluxo cidade
  public static function getCity($city, $id_estado)
  {
    $conn = new Database();

    $getCity = $conn->executeQuery('SELECT id_cidade FROM cidade WHERE nome = :city AND fk_estado_id_estado = :estado', array(
      ':city'   => $city,
      ':estado'  => $id_estado
    ));

    return $getCity->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function registerCity($city, $id_estado)
  {
    $conn = new Database();
    
    $registerCity = $conn->executeQuery('INSERT INTO `cidade` (`nome`, `fk_estado_id_estado`) VALUES (:city, :estado)', array(
      ':city'   => $city,
      ':estado'  => $id_estado
    ));

    return $registerCity->fetchAll(PDO::FETCH_ASSOC);
  }

  // fluxo bairro
  public static function getDistrict($district, $id_cidade)
  {
    $conn = new Database();

    $getDistrict = $conn->executeQuery('SELECT id_bairro FROM bairro WHERE nome = :bairro AND fk_cidade_id_cidade = :cidade', array(
      ':bairro'   => $district,
      ':cidade'  => $id_cidade
    ));

    return $getDistrict->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function registerDistrict($district, $id_cidade)
  {
    $conn = new Database();
    
    $registerDistrict = $conn->executeQuery('INSERT INTO `bairro` (`nome`, `fk_cidade_id_cidade`) VALUES (:bairro, :cidade)', array(
      ':bairro'   => $district,
      ':cidade'  => $id_cidade
    ));

    return $registerDistrict->fetchAll(PDO::FETCH_ASSOC);
  }

  // fluxo endereco
  public static function registerAddress($cep, $street, $number, $complement, $id_bairro)
  {
    $conn = new Database();
    
    $registerAddress = $conn->executeQuery('INSERT INTO `endereco` (`cep`, `logradouro`, `numero`, `complemento`, `fk_bairro_id_bairro`) VALUES (:cep, :logradouro, :numero, :complemento, :bairro)', array(
      ':cep'          => $cep,
      ':logradouro'   => $street,
      ':numero'       => $number,
      ':complemento'  => $complement,
      ':bairro'       => $id_bairro
    ));

    return $registerAddress->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getAddress($cep, $street, $number, $complement, $id_bairro)
  {
    $conn = new Database();

    $getAddress = $conn->executeQuery('SELECT id_endereco FROM endereco WHERE cep = :cep AND logradouro = :logradouro AND numero = :numero AND complemento = :complemento AND fk_bairro_id_bairro = :bairro', array(
      ':cep'          => $cep,
      ':logradouro'   => $street,
      ':numero'       => $number,
      ':complemento'  => $complement,
      ':bairro'       => $id_bairro
    ));

    return $getAddress->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function getCompleteAddress($id)
  {
    $conn = new Database();

    $getAddress = $conn->executeQuery('SELECT ed.id_endereco, ed.logradouro, ed.numero, ed.complemento, ed.cep, br.id_bairro, br.nome as bairro, cd.id_cidade, cd.nome as cidade, es.id_estado, es.nome as estado, es.sigla
    FROM endereco ed
    LEFT JOIN bairro br
    ON ed.fk_bairro_id_bairro = br.id_bairro
    LEFT JOIN cidade cd
    ON br.fk_cidade_id_cidade = cd.id_cidade
    LEFT JOIN estado es
    ON cd.fk_estado_id_estado = es.id_estado
    LEFT JOIN organizacao org
    ON org.fk_endereco_id_endereco = ed.id_endereco
    WHERE org.fk_usuario_id_usuario = :id', array(
      ':id'          => $id
    ));

    return $getAddress->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function login($nameOrEmail, $password, $row){
    if($row == false) return false;

    $hashedPassword = $row->senha;
    if (password_verify($password, $hashedPassword)) {
      return $row;
    } else {
      return false;
    }
  }

  public function bot($mensagem)
  {
    $conn = mysqli_connect("localhost", "virtuarteuser", "virtuartepassword", "virtuarte") or die("Database Error");

    // getting user message through ajax
    $getMesg = mysqli_real_escape_string($conn, $mensagem);

    //checking user query to database query
    $check_data = "SELECT nome FROM usuario WHERE email LIKE '%$getMesg%'";
    $run_query = mysqli_query($conn, $check_data) or die("Error");

    // if user query matched to database query we'll show the reply otherwise it go to else statement
    if (mysqli_num_rows($run_query) > 0) {
      //fetching replay from the database according to the user query
      $fetch_data = mysqli_fetch_assoc($run_query);
      //storing replay to a varible which we'll send to ajax
      // $replay = $fetch_data['nome'];
      $retorno = $fetch_data['nome'];
      // echo $replay;
    } else {
      // echo "Sorry can't be able to understand you!";
      $retorno = "Sorry can't be able to understand you!";
    }

    return $retorno;
  }

  // new post
  public function newPost($legend, $midia)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO publicacao (legenda, midia, fk_usuario_id_usuario) VALUES (:legenda, :midia, :user)');
    // bind values
    $conn->bind(':legenda', $legend);
    $conn->bind(':midia', $midia);
    $conn->bind(':user', $user);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
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
  public function follow($id)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO segue (fk_usuario_id_usuario, fk_usuario_id_usuario_) VALUES (:followerId, :followingId)');
    // bind values
    $conn->bind(':followerId', $user);
    $conn->bind(':followingId', $id);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // unfollow
  public function unfollow($id)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('DELETE FROM segue WHERE fk_usuario_id_usuario = :followerId AND fk_usuario_id_usuario_ = :followingId');
    // bind values
    $conn->bind(':followerId', $user);
    $conn->bind(':followingId', $id);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
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

  public function toLike($id)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO curte (fk_usuario_id_usuario, fk_publicacao_id_publicacao, curtir) VALUES (:user, :post, :toLike)');
    // bind values
    $conn->bind(':user', $user);
    $conn->bind(':post', $id);
    $conn->bind(':toLike', 1);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function notLike($id)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('DELETE from curte 
    WHERE fk_usuario_id_usuario = :user AND fk_publicacao_id_publicacao = :post');
    // bind values
    $conn->bind(':user', $user);
    $conn->bind(':post', $id);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public static function liked()
  {
    $conn = new Database();

    $id = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT post.id_publicacao, post.fk_usuario_id_usuario 
    FROM publicacao as post 
    RIGHT JOIN curte 
    ON post.id_publicacao = curte.fk_publicacao_id_publicacao 
    WHERE curtir = 1 AND curte.fk_usuario_id_usuario = :ID', array(
      ':ID' => $id
    ));
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function comment($post, $comment)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('INSERT INTO interage (fk_publicacao_id_publicacao, fk_usuario_id_usuario, comentario) VALUES (:post, :user, :comment)');
    // bind values
    $conn->bind(':post', $post);
    $conn->bind(':user', $user);
    $conn->bind(':comment', $comment);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public static function showComment()
  {
    $conn = new Database();

    $id = (int)$_SESSION['usersId'];

    $result = $conn->executeQuery('SELECT itg.fk_publicacao_id_publicacao, itg.fk_usuario_id_usuario, itg.comentario, itg.id_interacao 
    FROM interage as itg 
    RIGHT JOIN publicacao as pu
    ON itg.fk_publicacao_id_publicacao = pu.id_publicacao 
    ');
    return $result->fetchAll(PDO::FETCH_ASSOC);
  }

  public function changePhoto($foto)
  {
    $conn = new Database();

    $user = (int)$_SESSION['usersId'];

    $conn->query('UPDATE usuario SET foto_perfil = :foto WHERE id_usuario = :ID');

    // bind values
    $conn->bind(':foto', $foto);
    $conn->bind(':ID', $user);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function delete($id)
  {
    $conn = new Database();

    $conn->query('DELETE from publicacao 
    WHERE id_publicacao = :post');
    // bind values
    $conn->bind(':post', $id);

    // execute
    if ($conn->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
