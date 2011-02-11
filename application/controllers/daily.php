<?php
class Daily extends Controller{
  function __construct (){
    parent::Controller();
    $this->load->model('MDaily');
  }

  function index(){
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/input',$data);
  }

  function submit(){
    if ($this->input->post('ajax')){
      if ($this->input->post('id')){
      	$this->MDaily->update();
      	$data['query'] = $this->MDaily->getAll();
      	$this->load->view('daily/show',$data);
      }else{
      	$this->MDaily->save();
      	$data['query'] = $this->MDaily->getAll();
      	$this->load->view('daily/show',$data);      
      }
      
    }else{
      if ($this->input->post('submit')){
          if ($this->input->post('id')){
            $this->MDaily->update();
            redirect('daily/index');
          }else{
            $this->MDaily->save();
            redirect('daily/index');
          }
      }
    }
  }

  function delete(){
    $id = $this->input->post('id');
    $this->db->delete('daily', array('id' => $id));
    $data['query'] = $this->MDaily->getAll();
    $this->load->view('daily/show',$data);
  }
  
  function jqGrid(){
  	$this->load->view('daily/grid');
  }
  
  function loadDataGrid(){
		$page = isset($_POST['page'])?$_POST['page']:1; // get the requested page
		$limit = isset($_POST['rows'])?$_POST['rows']:10; // get how many rows we want to have into the grid
		$sidx = isset($_POST['sidx'])?$_POST['sidx']:'name'; // get index row - i.e. user click to sort
		$sord = isset($_POST['sord'])?$_POST['sord']:''; // get the direction
 
		if(!$sidx) $sidx =1;
		$query = $this->MDaily->getAll();
	 
		$count = count($query);
 
		if( $count > 0 ) {
			$total_pages = ceil($count/$limit);    //calculating total number of pages
		} else {
			$total_pages = 0;
		}
	
		if ($page > $total_pages) $page=$total_pages;
		
		$start = $limit*$page - $limit; // do not put $limit*($page - 1)
		$start = ($start<0)?0:$start;  // make sure that $start is not a negative value 
 
		$responce->page = $page; 
		$responce->total = $total_pages; 
		$responce->records = $count; 
		$i=0; 
		foreach($query as $row) { 
			$responce->rows[$i]['id']=$row->id; 
			$responce->rows[$i]['cell']=array($i+1,$row->date,$row->name,$row->amount);
			$i++; 
		} 
		echo json_encode($responce); 
  }
}

