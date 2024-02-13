<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
	protected $table;
	//protected $dbname;
	protected $primaryKey;
	protected $protectFields = false;

	protected $db = [
		'DSN'      => '',
		'hostname' => 'localhost',
		'username' => 'root',
		//'password' => '',
		//'database' => '',
		'DBDriver' => 'MySQLi',
		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

	public function __construct($table, $primaryKey, $dbname = null)
	{
		parent::__construct();
		//$this->dbname = $dbname;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
		$this->db->setDatabase($dbname);
		/*if($dbname !== null){
			$this->db->setDatabase($dbname);
		}else{
			$this->db->setDatabase(session('db'));
		}*/
	}

	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];

	protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function beforeUpdate(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['user_password']))
			$data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
		return $data;
	}
}
