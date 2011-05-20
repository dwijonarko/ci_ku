<?php
class MDaily extends Model{
  function __construct (){
    parent::Model();
  }
  
  function getAll(){
    $this->db->select('id,date,name,amount');
    $this->db->from('daily');
    $this->db->limit(10);
    $this->db->order_by('id','ASC');
    $query = $this->db->get();
    
    return $query->result();
  }
  
  function getAllGrid($limit,$sidx,$sord){
    $this->db->select('id,date,name,amount');
    $this->db->from('daily');
    $this->db->limit($limit);
    $this->db->order_by($sidx,$sord);
    $query = $this->db->get();
    
    return $query->result();
  }
  
  function get($id){
    $query = $this->db->getwhere('daily',array('id'=>$id));
    return $query->row_array();		  
  }
  
  function save(){
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'date'=>$date,
      'name'=>$name,
      'amount'=>$amount
    );
    $this->db->insert('daily',$data);
  }
  
  function update(){
    $id   = $this->input->post('id');
    $date = $this->input->post('date');
    $name = $this->input->post('name');
    $amount=$this->input->post('amount');
    $data = array(
      'date'=>$date,
      'name'=>$name,
      'amount'=>$amount
    );
    $this->db->where('id',$id);
    $this->db->update('daily',$data);    
  }

}
