<?php
class Socket extends Model{
    public function __construct($pAction, $pTable, $pObjet, $pDateInsertion = null, $pId=null){
        $this->id = $pId;
		$this->action = $pAction;
		$this->table = $pTable;
        $this->objet = $pObjet;
        if($pDateInsertion == null)
            $this->dateInsertion = date('d/m/Y h:i:s a', time());
        else
            $this->dateInsertion = $pDateInsertion;
    }

    static public $tableName = "socket";
    protected $id;
	protected $action;
	protected $table;
    protected $objet;
    protected $dateInsertion;	
	
	static public function store($action,$table,$objet){
		$socket = new Socket($action,$table,$objet);
		Socket::insert($socket);
	}
	
	static public function read($socket){
		/* Effectuer le tratement */
		
		//Socket::delete($socket);
	}
	
	static public function insert($socket){
		//Socket::read($socket);
		$requete = "INSERT INTO ".self::$tableName." VALUES (DEFAULT,'".$socket->action."','".$socket->table."','".$socket->objet->toJson()."',CURRENT_TIMESTAMP)";
		//echo $requete;
		$query = db()->prepare($requete);
		$query->execute();
	}
	
	static public function delete($socket){
		$query = db()->prepare("DELETE FROM ".self::$tableName." WHERE id=".$socket->id);
		$query->execute();
		echo $requete;
	}
}
?>