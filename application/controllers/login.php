<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	/**
	 * Login
	 *
	 * Questa classe possiede tutti i metodi per effettuare il login
	 * dell'utente, verificare se non sia già loggato ecc...
	 * attualmente in data 28/10/12 e il controller principale.
	 * In caso l'utente sia già loggato reindirizza al controller
	 * dashboards 
	 * 
	 * @author  Carmine Milieni <carmine@milienistudios.it>
	 *  
	 * @since 0.1
	 */

	public function index(){
		
		/**
		 * index
		 *
		 * la funzione index funge da pilota
		 * verifica semplicemente la sessione dell'utente 
		 * se è già loggato reindirizza alla dashbord
		 * altrimenti richiama la funzione loginView che mostra il form di login
		 * 
		 * @return loginView|dashboard  $this->loginView or redirect('dashboard/dashboard')
		 * 
		 */
		
		if($this->session->userdata('user_session') == FALSE) {
			return $this->loginView();
		} else {
			return redirect('dashboard/dashboard');
		}
		
	}
	
	public function loginView(){
		
		/**
		 * loginView
		 *
		 * la funzione loginView
		 * setta tutti i parmetri per il form di login
		 * ed avvia la vista con il form
		 *
		 * @return View  $this->load->view('login/login', $data)
		 *
		 */
		
		$this->load->helper('form');
		
		$data['form'] = 'login/loginUser';
		
		$data['input_username'] = array(
				'name'        => 'username',
				'id'          => 'username',
				'value'       => '',
				'maxlength'   => '25',
				'size'        => '50',
				'style'       => ''
		);
		
		$data['input_passwd'] = array(
				'name'        => 'passwd',
				'id'          => 'passwd',
				'value'       => '',
				'maxlength'   => '25',
				'size'        => '50',
				'style'       => ''
		);
		
		$data['input_submit'] = array(
				'name'        => 'submit',
				'id'          => 'submit',
				'value'       => 'Login',
				'style'       => ''
		);
		
		return $this->load->view('login/login', $data);
		/*echo form_open();
		 echo form_input();
		echo form_password();
		echo form_close();
		print 'Start CodePlatform Develop';
		$this->load->helper('language');
		$this->lang->load('general', 'italiano');
		echo lang('general_message','form');
		$c= print $this->lang->line('error_email_missing');*/
	}
	
	public function loginUser(){
	
		/**
		 * loginUser
		 *
		 * la funzione loginUser ricava i dati inseriti dall'utente tramite la
		 * variabile Post carcica il model adatto, verica la correttezza dei dati
		 * in caso siano veritieri avvia la sessione utente altrimenti reindirizza
		 * al login con un messaggio di errore
		 *
		 * @return
		 *
		 */
		
		//setto la validazione
		$config = array(
				array(
						'field'   => 'username',
						'label'   => 'Username',
						'rules'   => 'trim|required|max_length[25]|xss_clean'
				),
				array(
						'field'   => 'passwd',
						'label'   => 'Password',
						'rules'   => 'trim|required|max_length[25]|xss_clean|md5'
				)
		);
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules($config);
		
		//verifico se i campi inseriti rispettano la validazione
		if ($this->form_validation->run() == FALSE)
			return $this->loginView(); //carico la schermata di login
		
	    //carico il model per verificare la corrispondenza username/password
	    $this->load->model('login_model');
	    $data_user = array(
	    		             'username' => $this->input->post('username'), 
	    		             'passwd' => $this->input->post('passwd')
	    		);
	    $this->login_model->userAuth($data_user);
		
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login/login.php */