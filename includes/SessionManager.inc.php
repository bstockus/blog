<?php

/*
In order to store session in a database you must  have a table set up in the db
that has the proper columns....

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(32) NOT NULL,
  `access` int(10) unsigned default NULL,
  `data` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/


class SessionManager{
	private $con;
	private $db;
	private $user;
	private $pass;
	private $host;
	
	function __construct($host,$db,$user,$pass,$con = null){
		$this->con = $con;
		$this->host = $host;
		$this->db = $db;
		$this->user = $user;
		$this->pass = $pass;
	}
	function _open(){
		//note that if you use a separate db you store sessions, you may run into troubles, so I'm using a separate connection object for sesssion management
		if($this->con){
			return TRUE;	
		}
		if($this->con = mysqli_connect($this->host, $this->user, $this->pass)){
			return mysqli_select_db($this->db);
		}
		return FALSE;
	}
 	function _close(){
		mysqli_close($this->con);
	}
	function _read($id){
		$id = mysqli_real_escape_string($this->con,$id);
   		$sql = "SELECT data FROM sessions WHERE id = '$id'";
  		if ($result = mysqli_query($this->con,$sql)) {
			if (mysqli_num_rows($result)) {
				$record = mysqli_fetch_assoc($result);
				return $record['data'];
			}
		}
		return '';
	}

	function _write($id, $data){
		$access = time();
		$id = mysqli_real_escape_string($this->con,$id);
		$access = mysqli_real_escape_string($this->con,$access);
		$data = mysqli_real_escape_string($this->con,$data);
		$sql = "REPLACE INTO sessions VALUES ('$id', '$access', '$data')";
		return mysqli_query($this->con,$sql);
	}

	function _destroy($id){
		$id = mysqli_real_escape_string($this->con,$id);
		$sql = "DELETE FROM sessions WHERE id = '$id'";
		return mysqli_query($this->con,$sql);
	}

	function _clean($max){
		$old = time() - $max;
		$old = mysqli_real_escape_string($this->con,$old);
		$sql = "DELETE FROM sessions WHERE access < '$old'";
		return mysqli_query($this->con,$sql);
	}
}
