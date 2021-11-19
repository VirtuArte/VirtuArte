<?php

use Application\core\Controller;

class User extends Controller
{
  /**
  * chama a view index.php da seguinte forma /user/index   ou somente   /user
  * e retorna para a view todos os usuários no banco de dados.
  */
  public function index()
  {
    $Users = $this->model('Users'); // é retornado o model Users()
    $data = $Users::findAll();
    $this->view('user/index', ['users' => $data]);
  }

  /**
  * chama a view show.php da seguinte forma /user/show passando um parâmetro 
  * via URL /user/show/id e é retornado um array contendo (ou não) um determinado
  * usuário. Além disso é verificado se foi passado ou não um id pela url, caso
  * não seja informado, é chamado a view de página não encontrada.
  * @param  int   $id   Identificado do usuário.
  */
  public function show($id = null)
  {
    if (is_numeric($id)) {
      $Users = $this->model('Users');
      $data = $Users::findById($id);
      $this->view('user/show', ['user' => $data]);
    } else {
      $this->pageNotFound();
    }
  }

  //Register User
  public function register(){
    //Process form
    
    //Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Init data
    $data = [
        'username'    => trim($_POST['floatingSignInUsername']),
        'email'       => trim($_POST['floatingSignInEmail']),
        'nome'        => trim($_POST['floatingSignInName']),
        'senha'       => trim($_POST['floatingSignInPass'])
        // 'senhaConfirm' => trim($_POST['senhaConfirm']),
        // 'foto_perfil' => trim($_POST['foto_perfil'])
    ];

    //Validate inputs
    // if(empty($data['username']) || empty($data['email']) || empty($data['nome']) || 
    // empty($data['senha']) || empty($data['senhaConfirm'])){
    //     flash("register", "Please fill out all inputs");
    //     redirect("../signup.php");
    // }

    // if(!preg_match("/^[a-zA-Z0-9]*$/", $data['nome'])){
    //     flash("register", "Invalid username");
    //     redirect("../signup.php");
    // }

    // if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
    //     flash("register", "Invalid email");
    //     redirect("../signup.php");
    // }

    // if(strlen($data['senha']) < 6){
    //     flash("register", "Invalid password");
    //     redirect("../signup.php");
    // } else if($data['senha'] !== $data['senhaConfirm']){
    //     flash("register", "Passwords don't match");
    //     redirect("../signup.php");
    // }

    //User with the same email or password already exists
    // if($this->userModel->findUserByEmailOrUsername($data['email'], $data['username'])){
    //     flash("register", "Username or email already taken");
    //     redirect("../signup.php");
    // }

    //Passed all validation checks.
    //Now going to hash password
    $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

    $Users = $this->model('Users');
    $dataUser = $Users::register((array)$data);

    //Register User
    // if($this->userModel->register($data)){
    //     redirect("../login.php");
    // }else{
    //     die("Something went wrong");
    // }
  }

  public function login(){
    //Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Init data
    $data=[
        'name/email' => trim($_POST['floatingLoginUsername']),
        'password' => trim($_POST['password'])
    ];

    if(empty($data['name/email']) || empty($data['password'])){
        flash("login", "Please fill out all inputs");
        header("location: ../login.php");
        exit();
    }

    //Check for user/email
    if($this->userModel->findUserByEmailOrUsername($data['name/email'], $data['name/email'])){
        //User Found
        $loggedInUser = $this->userModel->login($data['name/email'], $data['password']);
        if($loggedInUser){
            //Create session
            $this->createUserSession($loggedInUser);
        }else{
            flash("login", "Password Incorrect");
            redirect("../login.php");
        }
    }else{
        flash("login", "No user found");
        redirect("../login.php");
    }
  }

  public function createUserSession($user){
      $_SESSION['usersId'] = $user->usersId;
      $_SESSION['usersName'] = $user->usersName;
      $_SESSION['usersEmail'] = $user->usersEmail;
      redirect("../index.php");
  }

  public function logout(){
      unset($_SESSION['usersId']);
      unset($_SESSION['usersName']);
      unset($_SESSION['usersEmail']);
      session_destroy();
      redirect("../index.php");
  }

}
