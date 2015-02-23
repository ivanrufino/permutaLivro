<?php

class DatabaseDump {
    private $db;
    private $host, $user, $pass, $dbname;
    private $sql, $removeAI;

    public function __construct($host, $user, $pass, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
        $this->removeAI = false;

        try {
            $this->db = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();          
            die;
        }
    }

    private function ln($text = '') {
        $this->sql = $this->sql . $text . "\n";
    }

    public function dump($file) {
        $this->ln("SET FOREIGN_KEY_CHECKS=0;\n");

        $tables = $this->db->query('SHOW TABLES')->fetchAll(PDO::FETCH_BOTH);

        foreach ($tables as $table) {
            $table = $table[0];
            $this->ln('DROP TABLE IF EXISTS `'.$table.'`;');

            $schemas = $this->db->query("SHOW CREATE TABLE `{$table}`")->fetchAll(PDO::FETCH_ASSOC);

            foreach ($schemas as $schema) {
                $schema = $schema['Create Table'];
                if($this->removeAI) $schema = preg_replace('/AUTO_INCREMENT=([0-9]+)(\s{0,1})/', '', $schema);
                $this->ln($schema.";\n\n");
            }
        }

        file_put_contents($file, $this->sql);
    }
    public function teste(){
        echo 'teste';
    }
}
//$file=new DatabaseDump('mysql.hostinger.com.br','u762709049_tcc','akuma2010','u762709049_tcc');
//$file=new DatabaseDump('localhost','root','himura08','institutobz');
//$arquivo=$file->dump('banco.sql');


//$tabelas=array('tcc_receita','tcc_pessoa','tcc_paciente');
backup_tables('mysql.hostinger.com.br','u762709049_tcc','akuma2010','u762709049_tcc');


/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	//print_r($tables);die();
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
        $return="";
        foreach (array_keys($tables, 'ci_sessions') as $key) {
            unset($tables[$key]);
        }
        echo "mostrando tabelas<br>";
        //print_r($tables);die();
	foreach($tables as $table)
	{
            echo "->". $table."<br>";
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}
?>