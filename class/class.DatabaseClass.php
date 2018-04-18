  <?php
  include 'class.Password.php';
  /*
  *	Modified Database Class
  */
  
  class DatabaseClass extends Password
  {
  // Database connection object
  private $pdo;
  // Create a PDO object and connect to the database

      /**
       * DatabaseClass constructor.
       * @param $dbName
       * @param $dbHost
       * @param $dbUser
       * @param $dbPass
       */
      public function __construct($dbName, $dbHost, $dbUser, $dbPass) {
  try {
	  parent::__construct();
  // Instantiate the PDO object
  $this->pdo = new PDO(
  // Use MySQL database driver
  "mysql:dbname=$dbName;host=$dbHost",
  $dbUser,
  $dbPass,
  // Set some options
  array(
  // Return rows found, not changed, during inserts/updates
  PDO::MYSQL_ATTR_FOUND_ROWS => true,
  // Emulate prepares, in case the database doesn't support it
  PDO::ATTR_EMULATE_PREPARES => true,
  // Have errors get reported as exceptions, easier to catch
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  // Return associative arrays, good for JSON encoding
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  )
  );
  }
  catch (PDOException $e) {
  die('Database Connection Failed: ' . $e->getMessage());
  }
  }


  // Perform a SELECT query
  public function select($sql, $data = array()) {
  try {
  // Prepare the SQL statement
  $stmt = $this->pdo->prepare($sql);

  // Execute the statement
  if ($stmt->execute($data)) {
  // Return the selected data as an assoc array
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  else {
  return false;
  }
  }
  catch (Exception $e) {
  return false;
  }
  }



  public function selectcount($sql)
  {
	  try{
		  $stmt = $this->pdo->prepare($sql);
		  $colcount = $stmt->columnCount();
		  return $colcount;  
	  }catch(PDOException $e){
		  return $e->getMessage();
	  }
  }
  
  public function getconn()
  {
    return $this->pdo;
  }
  
  // Perform an INSERT query
  public function insert($sql, $data = array()) {
  try {
  // Prepare the SQL statement
  $stmt = $this->pdo->prepare($sql);

  // Execute the statement
  if ($stmt->execute($data)) {
  // Return the number of rows affected
      echo $this->pdo->lastInsertId();
  return $this->pdo->lastInsertId();
  }
  else {
  return false;
  }
  }
  catch (Exception $e) {
  return $e->getMessage();
  }
  }
  // Perform an UPDATE query
  public function update($sql, $data = array()) {
  return $this->insert($sql, $data);
  }
  // Perform a REPLACE query
  public function replace($sql, $data = array()) {
  return $this->replace($sql, $data);
  }
  // Perform a DELETE query
  public function delete($sql, $data = array()) {
  return $this->insert($sql, $data);
  }
  // Get the ID of the last row inserted
  public function lastInsertId() {
  return $this->pdo->lastInsertId();
  }

      /**
       * @param $sql
       * @param array $data
       * @return int
       */
      public function updatetabl($sql)
  {
    $stmt = $this->pdo->prepare($sql);
    if ($stmt->execute())
        return true;
    return false;
  }
  
  public function howmanyin($table, $condition, $conditionvalue)
  {
	  $sql = "SELECT count(*) As total FROM ".$table." WHERE ".$condition." = ".$conditionvalue;
	  $res = $this->pdo->query($sql);
	  $rowcount = $res->fetchColumn();
	  return $rowcount;
  }
   public function howmanyinone($table)
  {
    $sql = "SELECT count(*) As total FROM ".$table;
    $res = $this->pdo->query($sql);
    $rowcount = $res->fetchColumn();
    return $rowcount;
  }
  
  public function populatewith($table, $condition, $conditionvalue)
  {
	  try{
	  $sql = "SELECT * FROM ".$table." WHERE ".$condition." = ".$conditionvalue;
	  //$sql = "SELECT * FROM :table WHERE :condition = :conditionvalue";
	  //$param = array('table' => $table, 'condition' => $condition, 'conditionvalue' => $conditionvalue);
	  //return $this->select($sql, $param);
	  $stmt = $this->pdo->prepare($sql);
	  $stmt->execute();
	  return $stmt->fetchAll();
	  }catch(PDOExeception $e){
		  return $e->getMessage();
	  }
  }


public function selectsearch($sql)
  {
    try{
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOExeception $e){
      return $e->getMessage();
    }
  }


  
  public function showone($table, $condition, $conditionvalue)
  {
	  
	  try{
	  $sql = "SELECT * FROM ".$table." WHERE ".$condition." = ".$conditionvalue;
	  //$sql = "SELECT * FROM :table WHERE :condition = :conditionvalue";
	  //$param = array('table' => $table, 'condition' => $condition, 'conditionvalue' => $conditionvalue);
	  //return $this->select($sql, $param);
	  $stmt = $this->pdo->prepare($sql);
	  $stmt->execute();
	  return $stmt->fetch();
	  }catch(PDOExeception $e){
		  return $e->getMessage();
	  }
  }
  
  public function updateone($table, $column, $data, $condition, $conditionvalue)
  {
	  $sql = "UPDATE ".$table." SET ".$column." = ".$data." WHERE ".$condition." = ".$conditionvalue;
	  $stmt = $this->pdo->prepare($sql);
	  $stmt->execute();
	  return $stmt->rowCount();
  }
  
  
  public function register($username, $password){
	  //$arr = array();
	  //$arr = ("pass" => $password);
	  $hashedpassword = $this->password_hash($password, PASSWORD_DEFAULT);
	  $sql = 'INSERT INTO user (username,password) VALUES (:username, :password)';
	  $data = array( 'username' => $username, 'password' => $password);
	//print_r($hashedpassword);print_r($username);exit;
	  return $this->insert($sql, $data);
  }
  
  private function get_user_hash($username){

		try {

			$stmt = $this->pdo->prepare('SELECT id, username, password FROM user WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}
  
  public function checkpass($pass, $hashed){
	  if($pass==$hashed)
	  return true;
	    
  }
  
  public function login($username,$password){

		$user = $this->get_user_hash($username);

		if($this->checkpass($password,$user['password'])){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['id'] = $user['id'];
		    $_SESSION['username'] = $user['username'];
		    return true;
		}
	}

  public function isloggedin()
  {
    if (isset($_SESSION['loggedin'])) {
      return true;
    }
  }

  function search($searchtable, $searchvalue)
{

    
    $sql = "SELECT * FROM ".$searchtable." WHERE name LIKE concat('%':searchvalue'%')";
    $param = array(':searchvalue' => $searchvalue );
    $stmt = $this->pdo->prepare($sql);
    if($stmt->execute($param)){
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }else{
      return false;
    }
    
}

      /**
       * @return PDO
       */
      public function getPdo ()
      {
          return $this->pdo;
      }

      /**
       * @param PDO $pdo
       */
      public function setPdo(PDO $pdo)
      {
          $this->pdo = $pdo;
      }

  } 
  ?>