<?php
/*************************************************************************
Connect to database mySQL
----------------------------------------------------------------
BiDo.vn Project
Company: Derasoft Co., Ltd
Last updated: 07/01/2010
**************************************************************************/
class DB {
	var $connection;
	var $initialized = 0;
	var $query_id = 0;	

/*-----------------------------------------------------------------------*
* Function: Constructor
* Parameter: DB host, DB user, DB pass, DB name, persistent connection
* Return: No return
*-----------------------------------------------------------------------*/	
	function DB() {
		if(!$this->initialized) return $this->initialize();
	}

/*-----------------------------------------------------------------------*
* Function: Construction
* Parameter: DB host, DB user, DB pass, DB name, persistent connection
* Return: 0 if failed, connection ID if success
*-----------------------------------------------------------------------*/	
	function initialize($db_pconnect = 0, $db_server = '', $db_user = '', $db_pass = '', $db_name = '') {
		global $config;
		$connect_handle = $db_pconnect?"mysql_pconnect":"mysql_connect";
		if (!$this->connection = @$connect_handle($db_server?$db_server:$config['db_server'], $db_user?$db_user:$config['db_user'], $db_pass?$db_pass:$config['db_pwd'])) {
			$this->error('Database initialize failed!'.(QUERY_ERROR?'<br />&raquo;&nbsp;Error detail: '.@mysql_error():'<br />&raquo;&nbsp;Please turn on QUERY_ERROR to view the error detail messages.'), 1);
			return 0;	
		}
		@mysql_query("SET character_set_results=utf8", $this->connection);
		@mysql_query("SET character_set_client=utf8", $this->connection);
		@mysql_query("SET character_set_connection=utf8", $this->connection);
		@mb_language('uni');
		@mb_internal_encoding('UTF-8');
		@mysql_query("set names 'utf8'",$this->connection);
		if (!@mysql_select_db($db_name?$db_name:$config['db_name'], $this->connection)) {
			$this->error('Database initialize failed!'.(QUERY_ERROR?'<br />&raquo;&nbsp;Error detail: '.@mysql_error($this->connection):'<br />&raquo;&nbsp;Please turn on QUERY_ERROR to view the error detail messages.'),1);
			@mysql_close($this->connection);
			return 0;
		}
		$this->initialized = 1;
		return $this->connection;
	}

/*-----------------------------------------------------------------------*
* Function: Close connection
* Parameter: 
* Return: 1 if OK, 0 if failed 
*-----------------------------------------------------------------------*/
	function close() {
		if ($this->connection) {
			if (is_object($this->query_id)) @mysql_free_result($this->query_id);
			return @mysql_close($this->connection);
		} else return 0;
	}
	
/*-----------------------------------------------------------------------*
* Function: execute query
* Parameter: query string
* Return: query_id if OK, return 0 & echo error if failed, stop program if halt is TRUE
*-----------------------------------------------------------------------*/
	function query($query = '', $halt = 0)
	{
		if(!$this->initialized) $this->initialize();
		if ($query == '') return 0;
		if(DEBUG1) {
			global $query_count;
			$query_count++;
		}
		if(!$this->query_id = @mysql_query($query,$this->connection)) {
			$this->error('Database query failed!'
.'<br />&raquo;&nbsp;Error No: '.@mysql_errno($this->connection)
.(QUERY_ERROR?'<br />&raquo;&nbsp;Error detail: '.@mysql_error($this->connection):'<br />&raquo;&nbsp;Please turn on QUERY_ERROR to view the error detail messages.')
.(QUERY_DEBUG?'<br />&raquo;&nbsp;Query: '.$query:'<br />&raquo;&nbsp;Please turn on QUERY_DEBUG to view the query.'));
			if($halt) exit;
			return 0;
		}
		return $this->query_id;
	}

/*-----------------------------------------------------------------------*
* Function: fetch array
* Parameter: query id, associative
* Return: associative array, 0 if failed
*-----------------------------------------------------------------------*/
	function fetchArray($query_id = -1, $assoc = 0) {
		if ($query_id != -1) $this->query_id = $query_id;
		if ($this->query_id) return $assoc?@mysql_fetch_assoc($this->query_id):@mysql_fetch_array($this->query_id);
		return 0;
	}
	
/*-----------------------------------------------------------------------*
* Function: fetch row
* Parameter: query id, associative
* Return: array, 0 if failed
*-----------------------------------------------------------------------*/
	function fetchRow($query_id = -1) {
		if ($query_id != -1) $this->query_id = $query_id;
		if ($this->query_id) return @mysql_fetch_row($this->query_id);
		return 0;
	}	

/*-----------------------------------------------------------------------*
* Function: moves the internal row pointer of the MySQL result associated to first row 
* Parameter: query id 
* Return: 1 if OK, 0 if failed
*-----------------------------------------------------------------------*/
	function goFirstRow($query_id = -1) {
		if ($query_id != -1) $this->query_id = $query_id;
		if ($this->query_id) {
			$rows = @mysql_num_rows($this->query_id);
			if ($rows > 0) {
				return @mysql_data_seek($this->query_id, 0);
			}
		} else return 0;
	}

/*-----------------------------------------------------------------------*
* Function: Free result memory 
* Parameter: query id 
* Return: 1 if OK, 0 if failed
*-----------------------------------------------------------------------*/
	function freeResult($query_id = -1) {
		if ($query_id != -1) {
			$this->query_id = $query_id;
			return @mysql_free_result($this->query_id);
		}
		return 0;
	}

/*-----------------------------------------------------------------------*
* Function: get first row in result
* Parameter: query string
* Return: first row
*-----------------------------------------------------------------------*/
	function getFirstRow($query = '') {
		if($query != '') $this->query($query);
		if($this->query_id) $result = $this->fetchArray($this->query_id);
		$this->freeResult();
		return $result;
	}

/*-----------------------------------------------------------------------*
* Function: Get number of rows in result
* Parameter: query id
* Return: number of rows
*-----------------------------------------------------------------------*/
	function getNumRows($query_id = -1) {
		if ($query_id != -1) $this->query_id = $query_id;
		return @mysql_num_rows($this->query_id);
	}

/*-----------------------------------------------------------------------*
* Function: Get the ID generated from the previous INSERT operation
* Parameter: 
* Return: ID generated
*-----------------------------------------------------------------------*/
	function getInsertId() {
		return @mysql_insert_id($this->connection);
	}
  
/*-----------------------------------------------------------------------*
* Function: Get number of fields in result
* Parameter: query id
* Return: number of fields
*-----------------------------------------------------------------------*/
	function getNumFields($query_id = -1) {
		if ($query_id != -1) $this->query_id = $query_id;
		return @mysql_num_fields($this->query_id);
	}

/*-----------------------------------------------------------------------*
* Function: display error
* Parameter: 
* Return: exit program if halt is TRUE
*-----------------------------------------------------------------------*/
    function error($errmsg, $halt = 0) {
		echo "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 //EN'>
<html>
<head>
<title>Database error</title>
</head>
<body>
<h2>ERROR From DB mySQL</h2>
<span style=\"color:#ff0000; font-weight: strong\">DB Error</span>: $errmsg
</body>
</html>";
		if ($halt) exit;
    }
}
?>