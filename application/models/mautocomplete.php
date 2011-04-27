<?php
class MAutocomplete extends Model{

	function __construct(){
		parent::Model();
	}
	
	function lookup($keyword){
		$this->db->select('*')->from('propinsi');
        $this->db->like('propinsi',$keyword,'after');
        $query = $this->db->get();    
        
        return $query->result();
	}
}
