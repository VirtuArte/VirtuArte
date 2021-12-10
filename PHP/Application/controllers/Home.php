<?php

use Application\core\Controller;

require_once '../Application/helpers/session_helper.php';

class Home extends Controller
{
  /*
  * chama a view index.php do  /home   ou somente   /
  */
  public function index()
  {
    $this->view('home/index');
  }

}
