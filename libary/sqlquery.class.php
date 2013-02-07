<?php
 class SQLQuery
 {
	//Fields
	protected $_dbHandle;
	
	
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
 }
?>