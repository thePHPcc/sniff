<?php

/**
 * This code is part of the sniff security demo application
 *
 * *** DO NOT USE IN ANY TYPE OF PRODUCTION ***
 *
 * The application is stripped down and contains various security issues to be found
 * by course attendees. It is not ment to be used as an actual social network or a
 * base for one.
 *
 * @author Arne Blankerts <arne@thephp.cc>
 * @copyright 2010 thePHP.cc - the PHP consulting company, Germany
 *
 */

class sniffDatabase {

	protected $dsn;
	protected $mysqli;

	public function __construct($dsn) {
		$this->dsn = parse_url($dsn);
	}

	public function query($sql) {
		if (!$this->mysqli) {
		   $this->mysqli = new MySQLi(
		      $this->dsn['host'],
		      isset($this->dsn['user']) ? $this->dsn['user'] : 'root',
		      isset($this->dsn['pass']) ? $this->dsn['pass'] : null,
		      substr($this->dsn['path'],1)
		   );
		}
		if (func_num_args()>1) {
		   $args = func_get_args();
         $sane = array();
         foreach($args as $v) {
            $sane[] = $this->mysqli->real_escape_string($v);
         }
		   $sql = vsprintf($sql, array_slice($sane,1));
		}
		$rc = $this->mysqli->query($sql);
		if (!$rc) {
		   throw new Exception($this->mysqli->error, $this->mysqli->errno);
		}
		return new sniffDatabaseResult($this, $rc);
	}

}

class sniffDatabaseResult {

   protected $result;
   protected $db;

   public function __construct(sniffDatabase $db, $rc) {
      $this->db = $db;
      $this->result = $rc;
   }

   public function __call($method, $params) {
      return call_user_func_array(array($this->result, $method), $params);
   }

   public function __get($var) {
      return $this->result->$var;
   }

}
