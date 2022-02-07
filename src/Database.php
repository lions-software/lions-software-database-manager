<?php

namespace LionsSoftware\DatabaseManager;

use \PDO;
use \PDOException;

class Database
{

  /**
   * Host de conexão com o banco de dados
   * @var string
   */
  private static $db_host;

  /**
   * Usuário do banco
   * @var string
   */
  private static $db_user;

  /**
   * Senha de acesso ao banco de dados
   * @var string
   */
  private static $db_pass;

  /**
   * Nome do banco de dados
   * @var string
   */
  private static $db_name;

  /**
   * Porta de acesso ao banco
   * @var integer
   */
  private static $db_port;

  /**
   * Driver do banco de dados
   * @var string
   */
  private static $db_driver;

  /**
   * Instancia de conexão com o banco de dados
   * @var PDO
   */

  protected static $pdo;
  /**
   * Método responsável por configurar a classe
   * @param  string  $host
   * @param  string  $name
   * @param  string  $user
   * @param  string  $pass
   * @param  integer $port
   * @param  string $driver
   */
  public static function config($host, $user, $pass, $db_name, $port, $driver)
  {
    self::$db_host    = $host;
    self::$db_user    = $user;
    self::$db_pass    = $pass;
    self::$db_name    = $db_name;
    self::$db_port    = $port;
    self::$db_driver  = $driver;
  }

  /**
   * Private construct - garante que a classe só possa ser instanciada internamente.
   */
  private function __construct()
  {
    try {

      switch (self::$db_driver) {
        case 'mysql':
          self::$pdo = new PDO(self::$db_driver . ':host=' . self::$db_host . ';dbname=' . self::$db_name, self::$db_user, self::$db_pass);
          break;

        case 'pgsql':
          self::$pdo = new PDO(self::$db_driver . ':host=' . self::$db_host . ' dbname=' . self::$db_name . ' port=' . self::$db_port . ' user=' . self::$db_user . ' password=' . self::$db_pass);
          break;

        case 'sqlsrv':
          self::$pdo = new PDO(self::$db_driver . ':Server=' . self::$db_host . ';Database=' . self::$db_name, self::$db_user, self::$db_pass);
          break;
      }

      self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Connection Error: ' . $e->getMessage());
    }
  }
  # Método estático - acessível sem instanciação.
  public static function Connection()
  {
    # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
    if (!self::$pdo) {

      new Database();
    }
    # Retorna a conexão.
    return self::$pdo;
  }
}
