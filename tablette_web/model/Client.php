<?php
class Client extends Model{
	public function __construct($id=null){
        $query = db()->prepare("SELECT * FROM client WHERE client_id = ?");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $query->execute();
    }

	protected client_id;
    protected client_nom;
    protected client_prenom;
    protected client_rue;
    protected client_rue;
    protected client_ville;
    protected client_cp;
    protected client_mail;
    protected client_tel;
}

?>