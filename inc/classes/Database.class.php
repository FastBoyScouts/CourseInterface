<?php

class Database {
	private $connection;
	private $queries = array();
	private $prefix = null;
	
	public function __construct( $server, $username, $password, $database ) {
		$this->connection = mysqli_connect( $server, $username, $password, $database );
	}

	public function getQueries( ) {
		return $this->queries;
	}

	public function numQueries( ) {
		return count( $this->getQueries() );
	}


	private function addQueryToList( $sql ) {
		array_push( $this->queries, $sql );
	}

	public function query( $sql ) {
		$this->addQueryToList($sql);
		return mysqli_query( $this->connection, $sql );
	}

	public function getConnection() {
		return $this->connection;
	}

	public function escapeString($str) {
		return mysqli_escape_string($this->getConnection(), $str);
	}
}

?>