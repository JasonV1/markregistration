<?php
 class SQLQuery
 {
	//Fields
	protected $_dbHandle;
	protected $_result;
	
	
	public function connect($host, $account, $pwd, $name)
	{
		$this->_dbHandle = mysql_connect($host, $account, $pwd);
		if ( $this->_dbHandle != 0 )
		{
			if (mysql_select_db($name, $this->_dbHandle))
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}

	public function query($query, $singleResult=0)
	{
		$this->_result = mysql_query($query, $this->_dbHandle);
		if ( $this->_result == 0 )
		{
			return 1;
		}
		if ( preg_match("/select/i", $query))
		{
			$result = array();
			$table = array();
			$field = array();
			$tempResults = array();
			$numOfFields = mysql_num_fields($this->_result);
			
			for ( $i = 0; $i < $numOfFields; $i++)
			{
				array_push($table, mysql_field_table($this->_result, $i));
				array_push($field, mysql_field_name($this->_result, $i));
			}
			
			while ($row = mysql_fetch_row($this->_result))
			{
				for ($i = 0; $i < $numOfFields; $i++)
				{
					$table[$i] = trim(ucFirst($table[$i]), "s");
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}
				if ($singleResult == 1)
				{
					mysql_free_result($this->_result);
					return $tempResults;
				}
				array_push($result, $tempResults);
			}
			mysql_free_result($this->_result);
			return $result;
		}
		if ( $this->_result == 0 )
		{
			return 1;
		}
	}
	
	public function fine_last_inserted_id()
	{
		return mysql_insert_id();
	}
 }
?>