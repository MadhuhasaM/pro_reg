<?php
class Update_textbox extends CI_Model{
	function __construct() {  
		parent::__construct(); // no operation 
	}
 	function index(){
    	//$this->db->where('id',$id)->update('registration',$data);
    }
	public function update_query($data){
		//print_r($data);die();
		$id = $data['ID'];
		$email = $data['email'];
		$query = $this->query("UPDATE registration SET email='$email' WHERE id='$id'");
	} 
}
?>		