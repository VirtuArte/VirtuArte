<?php

namespace Application\core;

use PDO;

class Database extends PDO
{
  // configuração do banco de dados
  private $DB_NAME = 'virtuarte';
  private $DB_USER = 'virtuarteuser';
  private $DB_PASSWORD = 'virtuartepassword';
  private $DB_HOST = 'localhost';
  private $DB_PORT = 3307;

  // will be de PDO object
  private $dbh;
  private $stmt;
  private $error;

  // armazena a conexão
  private $conn;

  public function __construct()
  {
    // Quando essa classe é instanciada, é atribuido a variável $conn a conexão com o db
    $this->conn = new PDO("mysql:dbname=$this->DB_NAME;host=$this->DB_HOST;port=$this->DB_PORT", $this->DB_USER, $this->DB_PASSWORD);

    // conexão do vídeo
    $dsn = 'mysql:host=' . $this->DB_HOST . ';dbname=' . $this->DB_NAME . ';port=' . $this->DB_PORT;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    // create PDO instance
    try {
      $this->dbh = new PDO($dsn, $this->DB_USER, $this->DB_PASSWORD, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }

  public function query(string $sql, ?int $fetchMode = null, ...$fetchModeArgs)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  // prepare statement with query
  /* public function query($sql)
  {
    $this->stmt = $this->dbh->prepare($sql);
  }*/

  // bind values to prepared statement usind named parameters
  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  // execute the prepared statement
  public function execute()
  {
    return $this->stmt->execute();
  }

  // return multiple records
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // return sigle records
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // get row count
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }

  /**
   * Este método recebe um objeto com a query 'preparada' e atribui as chaves da query
   * seus respectivos valores.
   * @param  PDOStatement  $stmt   Contém a query ja 'preparada'.
   * @param  string        $key    É a mesma chave informada na query.
   * @param  string        $value  Valor de uma determinada chave.
   */
  private function setParameters($stmt, $key, $value)
  {
    $stmt->bindParam($key, $value);
  }

  /**
   * A responsabilidade deste método é apenas percorrer o array de com os parâmetros
   * obtendo as chaves e os valores para fornecer tais dados para setParameters().
   * @param  PDOStatement  $stmt         Contém a query ja 'preparada'.
   * @param  array         $parameters   Array associativo contendo chave e valores para fornece a query
   */
  private function mountQuery($stmt, $parameters)
  {
    foreach ($parameters as $key => $value) {
      $this->setParameters($stmt, $key, $value);
    }
  }

  /**
   * Este método é responsável por receber a query e os parametros, preparar a query
   * para receber os valores dos parametros informados, chamar o método mountQuery,
   * executar a query e retornar para os métodos tratarem o resultado.
   * @param  string   $query       Instrução SQL que será executada no banco de dados.
   * @param  array    $parameters  Array associativo contendo as chaves informada na query e seus respectivos valores
   *
   * @return PDOStatement
   */
  public function executeQuery(string $query, array $parameters = [])
  {
    $stmt = $this->conn->prepare($query);
    $this->mountQuery($stmt, $parameters);
    $stmt->execute();
    return $stmt;
  }
}
