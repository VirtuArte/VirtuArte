<?php

use Application\core\Controller;

require_once '../Application/helpers/session_helper.php';

class User extends Controller
{
  // private $userModel;

  // public function __construct(){
  //   $this->userModel = new User;
  // }

  /**
   * chama a view index.php da seguinte forma /user/index   ou somente   /user
   * e retorna para a view todos os usuários no banco de dados.
   */
  public function index()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users->findAll();
    $this->view('user/index', ['users' => $data]);
  }

  public function cadastrar()
  {
    $this->view('user/signup');
  }

  public function login()
  {
    $this->view('user/login');
  }

  /**
   * chama a view show.php da seguinte forma /user/show passando um parâmetro 
   * via URL /user/show/id e é retornado um array contendo (ou não) um determinado
   * usuário. Além disso é verificado se foi passado ou não um id pela url, caso
   * não seja informado, é chamado a view de página não encontrada.
   * @param  int   $id   Identificado do usuário.
   */
  public function profile($id = null)
  {
    if (is_numeric($id)) {
      $Users = $this->model('Users');
      $dataUser = $Users->findById($_SESSION['usersId']);
      $data = $Users->findById($id);
      $posts = $Users->findPostsById($id);
      $suggestion = $Users->suggestionUser();
      $following = $Users->following();
      $liked = $Users->liked();
      $showComment = $Users->showComment();
      $address = $Users->getCompleteAddress($id);
      $this->view('user/profile', ['user' => $data, 'nav' => $dataUser, 'post' => $posts, 'suggestion' => $suggestion, 'following' => $following, 'liked' => $liked, 'showComment' => $showComment, 'address' => $address]);
    } else {
      $this->pageNotFound();
    }
  }

  //Register User
  public function register()
  {
    //Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Init data
    $data = [
      'username'      => trim($_POST['floatingSignInUsername']),
      'email'         => trim($_POST['floatingSignInEmail']),
      'nome'          => trim($_POST['floatingSignInName']),
      'senha'         => trim($_POST['floatingSignInPass']),
      'senhaConfirm'  => trim($_POST['floatingSignInConfirmPass']),
      'type'          => $_POST['typeProfile']
      // 'foto_perfil' => trim($_POST['foto_perfil'])
    ];

    // Validate inputs
    if (
      empty($data['username']) || empty($data['email']) || empty($data['nome']) ||
      empty($data['senha'])
    ) {
      flash("register", "Por favor, preencha todos os campos.");
      // redirect("../../public/index.php");
      $this->view('user/signup');
    }

    if (!preg_match("/^[a-zA-Z0-9]*$/", $data['username'])) {
      flash("register", "Nome de usuário inválido.");
      $this->view('user/signup');
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      flash("register", "E-mail inválido.");
      $this->view('user/signup');
    }

    if (strlen($data['senha']) < 6) {
      flash("register", "Senha inválida.");
      $this->view('user/signup');
    } else if ($data['senha'] !== $data['senhaConfirm']) {
      flash("register", "As senhas não combinam.");
      $this->view('user/signup');
    }

    $Users = $this->model('Users');

    //User with the same email or password already exists
    if ($Users->findUserByEmailOrUsername($data['email'], $data['username'])) {
      flash("register", "E-mail ou Nome de Usuário já cadastrados.");
      $this->view('user/signup');
    }

    //Passed all validation checks.
    //Now going to hash password
    $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);


    // Register User
    if ($Users->register($data)) {
      $codProfile = $Users::getLastProfile();

      
      if($data['type'] == "comercial"){
        $data = [
          'description' => trim($_POST['floatingDescription']),
          'value'       => trim($_POST['floatingValue']),
          'cep'         => trim($_POST['floatingCep']),
          'street'      => trim($_POST['floatingStreet']),
          'number'      => trim($_POST['floatingNumber']),
          'complement'  => trim($_POST['floatingComplement']),
          'district'    => trim($_POST['floatingDistrict']),
          'city'        => trim($_POST['floatingCity']),
          'state'       => trim($_POST['floatingState'])
        ];
  
        // fluxo estado
        $state = $Users::getState($data['state']);
        // var_dump($state);
        foreach($state as $estado){
          $id_estado = $estado['id_estado'];
        }
  
        // fluxo cidade
        $city = $Users::getCity($data['city'], $id_estado);
        if(count($city) == 0){
          $city = $Users::registerCity($data['city'], $id_estado);
          $city = $Users::getCity($data['city'], $id_estado);
        }
        foreach($city as $cidade){
          $id_cidade = $cidade['id_cidade'];
        }
  
        // fluxo bairro
        $district = $Users::getDistrict($data['district'], $id_cidade);
        if(count($district) == 0){
          $district = $Users::registerDistrict($data['district'], $id_cidade);
          $district = $Users::getDistrict($data['district'], $id_cidade);
        }
        foreach($district as $bairro){
          $id_bairro = $bairro['id_bairro'];
        }

        // fluxo endereço
        $address = $Users::getAddress($data['cep'], $data['street'], $data['number'], $data['complement'], $id_bairro);
        if(count($address) == 0){
          $address = $Users::registerAddress($data['cep'], $data['street'], $data['number'], $data['complement'], $id_bairro);
          $address = $Users::getAddress($data['cep'], $data['street'], $data['number'], $data['complement'], $id_bairro);
        }
        foreach($address as $endereco){
          $id_endereco = $endereco['id_endereco'];
        }
        
        $Users::registerCommercial((array)$codProfile, $data['description'], $data['value'], $id_endereco);
      }
      else if($data['type'] == "pessoal"){
        $Users::registerPersonal((array)$codProfile);
      }
      $this->view('user/login');
    } else {
      die("Oops... Algo de errado aconteceu.");
    }
  }

  public function open()
  {
    //Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Init data
    $data = [
      'name/email' => trim($_POST['floatingLoginUsername']),
      'usersPwd' => trim($_POST['floatingLoginPassword'])
    ];

    if (empty($data['name/email']) || empty($data['usersPwd'])) {
      flash("login", "Por favor, preencha todos os campos.");
      $this->view('user/login');
      exit();
    }

    $Users = $this->model('Users');

    // Check for user/email
    if ($Users->findUserByEmailOrUsername($data['name/email'], $data['name/email'])) {
      //User Found
      $row = $Users->findUserByEmailOrUsername($data['name/email'], $data['name/email']);
      $loggedInUser = $Users->login($data['name/email'], $data['usersPwd'], $row);
      if ($loggedInUser) {
        //Create session
        $this->createUserSession($loggedInUser);
      } else {
        flash("login", "Senha incorreta.");
        $this->view('user/login');
      }
    } else {
      flash("login", "Usuário não encontrado.");
      $this->view('user/login');
    }

    header('Location: /user/feed');
  }

  public function createUserSession($user)
  {
    $_SESSION['usersId'] = $user->id_usuario;
    $_SESSION['usersName'] = $user->nome;
    $_SESSION['usersEmail'] = $user->email;
    // redirect("../user/feed");
  }

  public function logout()
  {
    unset($_SESSION['usersId']);
    unset($_SESSION['usersName']);
    unset($_SESSION['usersEmail']);
    session_destroy();
    redirect("../index.php");
  }

  public function feed()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users->findAll();
    $dataUser = $Users->findById($_SESSION['usersId']);
    $posts = $Users->findPostsById($_SESSION['usersId']);
    $suggestion = $Users->suggestionUser();
    $following = $Users->following();
    $liked = $Users->liked();
    $showComment = $Users->showComment();
    $feed = $Users->findAllPosts();
    $this->view('user/feed', ['users' => $data, 'user' => $dataUser, 'post' => $posts, 'suggestion' => $suggestion, 'following' => $following, 'liked' => $liked, 'showComment' => $showComment, 'feed' => $feed]);
  }

  public function message()
  {
    if (isset($_POST['text'])) {
      $mensagem = $_POST['text'];

      $Users = $this->model('Users'); // é retornado o model Users()
      $data = $Users->bot($mensagem);
      $this->view('user/message', ['users' => $data]);
    }
  }

  public function chatbot()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users->findAll();

    $conn = mysqli_connect("localhost", "virtuarteuser", "virtuartepassword", "virtuarte") or die("Database Error");

    // getting user message through ajax
    $getMesg = mysqli_real_escape_string($conn, $_POST['text']);
    //checking user query to database query
    $check_data = "SELECT nome FROM usuario WHERE username LIKE '%$getMesg%'";
    $run_query = mysqli_query($conn, $check_data) or die("Error");
    // if user query matched to database query we'll show the reply otherwise it go to else statement
    if (mysqli_num_rows($run_query) > 0) {
      //fetching replay from the database according to the user query
      $fetch_data = mysqli_fetch_assoc($run_query);
      //storing replay to a varible which we'll send to ajax
      $replay = $fetch_data['replies'];
      echo $replay;
    } else {
      echo "Sorry can't be able to understand you!";
    }

    $this->view('user/feed', ['users' => $data]);
  }

  // new post
  public function publish()
  {
    //Init data
    $data = [
      'legenda' => trim($_POST['legend']),
      'midia' => trim($_POST['fileDragData'])
    ];

    $Users = $this->model('Users');

    $Users->newPost($data['legenda'], $data['midia']);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  // follow
  public function follow($id = null, $status = null)
  {
    if (is_numeric($id)) {
      $Users = $this->model('Users');

      if ($status == 'follow') {
        $Users->follow($id);
      } else if ($status = 'unfollow') {
        $Users->unfollow($id);
      }

      if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }

      // $this->view('user/profile', ['user' => $data, 'post' => $posts, 'suggestion' => $suggestion]);
    } else {
      // $this->pageNotFound();
    }
  }

  // Likes

  public function toLike($id = null, $status = null)
  {
    if (is_numeric($id)) {
      $Users = $this->model('Users');

      if ($status == 'like') {
        // echo 'like';
        $Users->toLike($id);
      } else if ($status = 'notLike') {
        // echo 'notLike';
        $Users->notLike($id);
      }

      if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }

      // $this->view('user/profile', ['user' => $data, 'post' => $posts, 'suggestion' => $suggestion]);
    } else {
      // $this->pageNotFound();
    }
  }

  public function publishComment($post = null)
  {
    //Init data
    $data = [
      'comentario' => trim($_POST['comment']),
    ];

    $Users = $this->model('Users');

    $Users->comment($post, $data['comentario']);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }

  public function publishPhotoProfile()
  {
    //Init data
    $data = [
      'foto' => trim($_POST['photoProfile']),
    ];
    
    $Users = $this->model('Users');

    $Users->changePhoto($data['foto']);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }


  public function deletePost($post = null)
  {

    $Users = $this->model('Users');

    $Users->delete($post);

    if (isset($_SERVER["HTTP_REFERER"])) {
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}
