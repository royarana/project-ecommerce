<?php

require './db.php';


Class Model {
	private $_columns = [];
	private $_conn;
	private $_connString;
	public $_table;
	private $_where = [];
	private $_values = [];
	private $_joins = [];
	private $_select = [];

	function __construct($table) {
		global $CONFIG;
		$this->_table = $table;
		$this->_connString = $CONFIG;
		$this->_setConnection();
	}

	function create($data) {
		$params = [];
		$columns = [];
		$values = [];
		$qs = [];

		foreach($data as $key => $value) {
			$params[] = $this->getType($value);
			$columns[] = $key;
			$values[] = $value;
			$qs[] = "?";
		}

		$colStmt = implode(", ", $columns);
		$valStmt = implode(", ", $qs);

		$insertStmt = "INSERT INTO {$this->_table} ({$colStmt}) values ({$valStmt})";
		$stmt = $this->_conn->prepare($insertStmt);
		$stmt->bind_param(implode("", $params), ...$values);
		$stmt->execute();
		return $stmt->insert_id;
	}

	function update($data) {
		$whereStmt = $this->whereStmt();
		$values = [];
		$params = [];

		foreach($data as $key => $value) {
			$columns[] = "{$key} = ?";
			$values[] = $value;
			$params[] = $this->getType($value);
		}

		foreach($this->_values as $value) {
			$values[] = $value;
			$params[] = $this->getType($value);
		}

		$colStmt = implode(",", $columns);
		$stmt = "UPDATE {$this->_table} set {$colStmt} {$whereStmt}";
		$updateStmt = $this->_conn->prepare($stmt);
		$updateStmt->bind_param(implode("", $params), ...$values);

		return $updateStmt->execute();
	}

	function clear() {
		 $this->_columns = [];
		 $this->_where = [];
		 $this->_values = [];
		 $this->_joins = [];
		 $this->_select = [];
	}

	function _setConnection() {
		$conn = $this->_connString;
		$this->_conn = new mysqli(
			$conn["localhost"],
			$conn["user"],
			$conn["password"],
			$conn["db"]
		);

		if ($this->_conn->connect_error) {
			die("MYSQL ERROR {mysqli_error()}");
		}
	}

	function _setColumns() {
		$columns = [];
		$result = $this->_conn->query("
			SHOW COLUMNS FROM {$this->_table}
		");

		while($row = $result->fetch_assoc()) {
		    $columns[] = "{$this->_table}.{$row['Field']}";
		}

		$this->_columns = $columns;
	}

	function _getColumns() {
		return $this->_columns;
	}

	function where($col, $value, $operator = "=") {
		$this->_where[] = array( "key" => "AND" , "value" => "{$col} ${operator} ?" );
		$this->_values[] = $value;
	}

	function orWhere($col, $value, $operator = "=") {
		$this->_where[] = array( "key" => "OR" , "value" => "{$col} ${operator} ?" );
		$this->_values[] = $value;
	}

	function join($table, $colA, $colB, $operator = "=") {
		$this->_joins[] = array( "join" => "INNER JOIN {$table} ON", "value" => "${colA} ${operator} {$colB}" );
	}

	function leftJoin($table, $colA, $colB, $operator = "=") {
		$this->_joins[] = array( "join" => "LEFT JOIN {$table} ON", "value" => "${colA} ${operator} {$colB}" );
	}

	function select($cols = "*") {
		if ($cols !== "") {
			$this->_columns = explode(", ", $cols);
		} else {
			$this->_setColumns();
		}

		$cols = implode(", ", $this->_columns);

		$this->_select = "SELECT {$cols} FROM {$this->_table} ";
	}

	function get() {
		$rows = $this->getRows();
		return $rows;
	}

	function getOne() {
		$rows = $this->getRows();

		if (!empty($rows)) {
			return array();
		}

		return $rows[0];
	}

	function whereStmt() {
		if (!empty($this->_where)) {
			$whereStr = "";
			foreach( $this->_where as $where ) {
				if ($whereStr === "") {
					$whereStr .= " WHERE {$where["value"]}";
				} else {
					$whereStr .= " {$where["key"]} {$where["value"]}";
				}
			}
			return $whereStr;
		}
		return "";
	}

	function getRows() {
		$result = [];
		$joinStr = "";
		$whereStr = $this->whereStmt();

		if (!empty($this->_joins)) {

			foreach( $this->_joins as $join ) {
				$joinStr .= " {$join["join"]} {$join["value"]}";
			}
		}

		$this->_select .= " {$joinStr} {$whereStr}";

		$stmt = $this->_conn->prepare($this->_select);

		//adds value
		/*
			i - integer
			d - double
			s - string
			b - BLOB
		*/

		$params = [];

		if (!empty($this->_values)) {
			foreach($this->_values as $value ) {
				$val = $this->getType($value);
				$params[] = $val;
			}
			$stmt->bind_param(implode("", $params), ...$this->_values);
		}
		
		$stmt->execute();
		$queryRes = $stmt->get_result();

		while ($data = $queryRes->fetch_assoc()) {
		    $result[] = $data;
		}

		return $result;
	}

	function getType($value) {
		return strtolower(gettype($value)[0]);
	}
} 

http_response_code(404)

/*
class Test extends Model {
	function __construct() {
		parent::__construct("TEST");
	}
}
$TestModel = new Test();
*/

/*
For Where and Inner Joins
	$TestModel->select("test_join.*");
	$TestModel->where("test.id", 2, ">=");
	$TestModel->orWhere("test.id", 1, "=");
	$TestModel->join("join_test", "test.id", "join_test.id");
	$TestModel->leftJoin("test_join", "test.id", "test_join.id");
	$result = $TestModel->getRows();
	print_r($result);
*/

/*
For Created
$id = $TestModel->create(array("username" => "sample_user"));
print_r($id);

*/

/*

For Updates
$TestModel->where('id', 5);
$res = $TestModel->update(
	array(
		"username" => "eticles"
	)
);
*/
?>