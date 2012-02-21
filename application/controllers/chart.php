<?php
class Chart extends Controller {
    function __construct(){
			parent::__construct();
			$this->load->model("MDaily");
    }

		function index(){
			$this->load->view("chart/index");
		}

		function getData(){
				$responce->cols[]=array("id"=>"","label"=>"Topping","pattern"=>"","type"=>"string");
				$responce->cols[]=array("id"=>"","label"=>"Slices","pattern"=>"","type"=>"number");
				$responce->rows[]["c"]=array(array("v"=>"Mushrooms","f"=>null),array("v"=>3,"f"=>null));
				$responce->rows[]["c"]=array(array("v"=>"Onions","f"=>null),array("v"=>1,"f"=>null));
				$responce->rows[]["c"]=array(array("v"=>"Olives","f"=>null),array("v"=>1,"f"=>null));
				$responce->rows[]["c"]=array(array("v"=>"Zuccini","f"=>null),array("v"=>1,"f"=>null));
				$responce->rows[]["c"]=array(array("v"=>"Pepperoni","f"=>null),array("v"=>3,"f"=>null));
 			echo json_encode($responce);
		}
}
