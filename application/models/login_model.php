<?php
class Login_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function userAuth($data_user){
    	
    	/**
    	 * userAuth
    	 *
    	 * @param $data_user
    	 *
    	 */
    	//@todo da capire perchè se effettuo richieste al db mi ritorna un messaggio di errore
    }

}

/* End of file login_model.php */
/* Location: ./application/models/login/login_model.php */