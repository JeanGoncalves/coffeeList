<?php 
require_once 'connectionKey.class.php';

/**
* Conexão com o mongodb
*/
class Connection
{	
	protected $user;
	protected $pass;
	protected $host;
	protected $port;

	private $mongoinstance;
	private $schema;
	private $table;

	function __construct( $database = null, $table = null ) {
		$key = new ConnectionKey;
		$this->user = $key->getUser();
		$this->pass = $key->getPass();
		$this->host = $key->getHost();
		$this->port = $key->getPort();
		self::connect();
		if( !empty($database) )
			self::setSchema( $database );
		if( !empty($table) )
			self::setTable( $table );
	}

	private function connect() {
		$this->mongoinstance = new MongoClient( 'mongodb://'.$this->user.':'.$this->pass.'@'.$this->host.':'.$this->port );
	}

	public function useBD( $schema ) {
		self::setSchema( $this->mongoinstance->selectDB($schema) );
	}

	public function useTable( $table ) {
		self::setTable( $this->schema->selectCollection( $table ) );
	}

	public function insert( $params ) {
		$this->table->insert( $params );
	}

	public function getAll() {
		$response = $this->table;
		return $response;
	}

	public function editId( $id, $params ) {
		$this->table->update(array('_id',$id),array('$set'=>$params));
	}

	public function removeId( $id ) {
		$this->table->remove(array('_id' => new MongoId($id)));
	}

	/*---------------- Setters ----------------*/

	private function setSchema( $schema ) { //Set
		$this->schema = $schema;
	}

	private function setTable( $table ) { //Set
		$this->table = $table;
	}
}