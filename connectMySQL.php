<?php

/*
 * A class to handle MySQL connection
 */
class MySQLDatabase {
    var $link;
    
    function connect() {
        $this->link = mysql_connect('localhost');
        if (!$this->link) {
            die('Not connected : ' . mysql_error());
        }
        $db = mysql_select_db('armybuilder', $this->link);
        if (!$db) {
            die('Cannot use : ' . mysql_error());
        }
        return $this->link;
    }
    
    function disconnect() {
        mysql_close($this->link);
    }
}

?>
