<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends Controller {

	function __construct()	{
		parent::Controller();
		$this->load->model('MAutocomplete');
	}
	
	function index(){
		$this->load->view('autocomplete/show');
	}
	
	function lookup(){
		// process posted form data (the requested items like province)
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->MAutocomplete->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->propinsi_id,
                                        'value' => $row->propinsi,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
            
        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
	}

}
