<?php
class DB{
	private $con;
	private $opt;
    private $table_name;

	public function __construct($param = array()){
		// start
		$this->opt = array(
		    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		    PDO::ATTR_PERSISTENT 		 => false
		);
		// end
    } 

    // start
    public function set($name,$value){
        $this->$name = $value;
    }
    // end

    // start
    public function connect(){
    	$this->connect_sub();
    }
    private function connect_sub($dbaccess = 1){
    	switch($dbaccess){
    		case 2 : $DBUSER = DBUSER2; $DBPASS = DBPASS2; break;
    		case 3 : $DBUSER = DBUSER3; $DBPASS = DBPASS3; break;
    		case 4 : $DBUSER = DBUSER4; $DBPASS = DBPASS4; break;
    		case 5 : $DBUSER = DBUSER5; $DBPASS = DBPASS5; break;
    		default : $DBUSER = DBUSER; $DBPASS = DBPASS;
    	}
    	try{
    		
			$this->con = new PDO('mysql:host='.DBHOST.
    								 ';dbname='.DBNAME, 
    								 $DBUSER, 
    								 $DBPASS,
    								 $this->opt);
		}
		catch(PDOException $e){
			if($dbaccess<5){
				$dbaccess++;
				$this->connect_sub($dbaccess);
			}
			else
				return false;
		}
    }
    // end

    // insert start
    public function insert($param,$returnType="ID"){
        $this->connect_sub();

        $arr = array();
        // start
        foreach($param as $key=>$value):
            $arr[] = "`".$key."`=:".  $key;
        endforeach;         
        $columns = implode(",",$arr);
        // end

        $q = "INSERT INTO ".$this->table_name." SET ".$columns;
        $stmt = $this->con->prepare($q);
        foreach($param as $key=>$val){ // BINDING WHERE VALUES
            $stmt->bindValue(":$key", "$val");
        }
        $stmt->execute();
        if($stmt->rowCount()>0){
            if($returnType=="ID") 
                return $this->con->lastInsertId();
            elseif($returnType=="COUNT")
                return $stmt->rowCount();
        }
        else
            return false;
    }
    // end

    // query
    public function query($query,$param=array(),$con=true){
        if($con)
            $this->connect();        
        $stmt = $this->con->prepare($query);
        foreach($param as $k=>$v){
            $stmt->bindValue(":".$k, $v);    
        }        
        $stmt->execute();
        
        return $stmt;
    }

    // STORED PROCEDURE
    private function start_proc($name,$param){
        $s = "";
        $param_str = "";
        foreach($param as $k=>$v){
            $s .= $v['pos'].' `'.$v['nam'].'` '.$v['typ'];
            if(isset($v['lim']))
                $s .='('.$v['lim'].')';
            $s .=',';
            if($v['pos']=="IN")
                $param_str .= ":".$v['nam'].'';
            else
                $param_str .= "@".$v['nam'].'';
            $param_str.=",";
        }
        $s = rtrim($s, ",");
        $param_str = rtrim($param_str, ",");
        // keep the indentions below please
        echo '

DROP PROCEDURE IF EXISTS `'.$name.'`;
CREATE PROCEDURE `'.$name.'`('.$s.')
func:BEGIN

';      
        return $param_str;
    }
    private function end_proc(){
        // keep the indentions below please
        echo '

END;';
    }
    private function bindtheParam($param,&$stmt){
        foreach($param as $k=>$v){
            if($v['pos']=="IN"){
                $stmt->bindParam(":".$v['nam'], $v['val']); 
            }
        }        
    }
    private function proc_result($name,$param){
        $haveReturn = false;
        $s = "";
        foreach($param as $k=>$v){
            if($v['pos']=="OUT"){
                $s .= '@'.$v['nam'].',';
                $haveReturn = true;
            }
        }
        $s = rtrim($s,',');
        if($haveReturn)
            return $this->con->query("select ".$s)->fetchAll(PDO::FETCH_ASSOC);
        else
            return false;
    }
    public function create_proc($name,$param,$addQuery=""){
        ob_start();
        $param_str = $this->start_proc($name,$param);
        require('stored-proc/'.$name.'.proc');
        $this->end_proc();
        $proc_string = ob_get_contents();
        ob_end_clean();

        //test
        //echo $proc_string;
        //end

        $query = "CALL ".$name."(".$param_str.")";
        $this->connect();
        $this->con->query($proc_string);
        $stmt = $this->con->prepare($query);
        $this->bindtheParam($param,$stmt);
        $stmt->execute();
        $stmt->closeCursor();

        // return if have result
        $return =  $this->proc_result($name,$param);

        if($addQuery!=""){            
            $return['OUT'] = $return[0];
            $return['QUERY'] = $this->con->query($addQuery)->fetchAll(PDO::FETCH_ASSOC);
            unset($return[0]);
        }
        return $return;
    }
    public function drop_proc($name){
        $this->con->query("DROP PROCEDURE IF EXISTS `".$name."`");
        $this->con = null;
    }
    
}