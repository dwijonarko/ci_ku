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

        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
		$start = ($start<0)?0:$start;  // make sure that $start is not a negative value

		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
        $searchField = isset($_POST['searchField']) ? $_POST['searchField'] : false;
        $searchOper = isset($_POST['searchOper']) ? $_POST['searchOper']: false;
        $searchString = isset($_POST['searchString']) ? $_POST['searchString'] : false;

        if ($_POST['_search'] == 'true') {
            $ops = array(
            'eq'=>'=', //equal
            'ne'=>'<>',//not equal
            'lt'=>'<', //less than
            'le'=>'<=',//less than or equal
            'gt'=>'>', //greater than
            'ge'=>'>=',//greater than or equal
            'bw'=>'LIKE', //begins with
            'bn'=>'NOT LIKE', //doesn't begin with
            'in'=>'LIKE', //is in
            'ni'=>'NOT LIKE', //is not in
            'ew'=>'LIKE', //ends with
            'en'=>'NOT LIKE', //doesn't end with
            'cn'=>'LIKE', // contains
            'nc'=>'NOT LIKE'  //doesn't contain
            );

            foreach ($ops as $key=>$value){
                if ($searchOper==$key) {
                    $ops = $value;
                }
            }
            if($searchOper == 'eq' ) $searchString = $searchString;
            if($searchOper == 'bw' || $searchOper == 'bn') $searchString .= '%';
            if($searchOper == 'ew' || $searchOper == 'en' ) $searchString = '%'.$searchString;
            if($searchOper == 'cn' || $searchOper == 'nc' || $searchOper == 'in' || $searchOper == 'ni') $searchString = '%'.$searchString.'%';

            $where = "$searchField $ops '$searchString' ";
        }

		if(!$sidx) $sidx =1;
        $count = $this->db->count_all_results('daily');

		if( $count > 0 ) {
			$total_pages = ceil($count/$limit);    //calculating total number of pages
		} else {
			$total_pages = 0;
		}

		if ($page > $total_pages) $page=$total_pages;
   		$query = $this->MDaily->getAllGrid($start,$limit,$sidx,$sord,$where);

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
		foreach($query as $row) {
			$responce->rows[$i]['id']=$row->id;
			$responce->rows[$i]['cell']=array($row->date,$row->name,$row->amount);
			$i++;
		}
		echo json_encode($responce);
  }
}

