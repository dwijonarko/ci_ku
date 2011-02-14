<?php
class Chain extends Controller{

	function __construct(){
		parent::Controller();
		$this->load->model('MChain');
	}
	
	function index(){
		
		$data['option_propinsi'] = $this->MChain->getPropinsiList();
		$this->load->view('chain/index',$data);
	}
	
	function select_kota(){
		$data['option_kota'] = $this->MChain->getKotaList();		
		$this->load->view('chain/kota',$data);
	}
}
?>
