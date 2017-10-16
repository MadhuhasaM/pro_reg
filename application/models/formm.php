<?php
class Formm extends CI_Model{
	function __construct() {  
		parent::__construct(); // no operation 
	}
	function form_insert($data){ 
		$this->db->insert('registration', $data);        
	}
	function database(){
		
	  $this->db->select("registration.id,registration.name as rname,registration.email,registration.number,country.name,city.city,registration.upload");
	  $this->db->from('registration');
	  $this->db->join('city','city.id = registration.city','inner');
	  $this->db->join('country','country.id = registration.country','inner');
	  $this->db->order_by('registration.id', 'desc');
	  $query = $this->db->get();  
	  $result=$query->result(); 
	  return $result;
    }
	function form_delete($id){ 

		$this->db->delete("registration",array('id' => $id));
	}
	
	function up_form_view($id){   
        $this->db->select("*");
		$this->db->from('registration');
		$this->db->where('id',$id);
		$query = $this->db->get(); 
		$result=$query->row();  
		return $result;   
	}
	function form_update($data1,$id){
		$this->db->where('id',$id)->update('registration',$data1);
	}
	function country_insert($data){ 
		$this->db->insert('country', $data);        
	}
	function city_insert($data){ 
		$this->db->insert('city', $data);        
	}
    function country(){
    	$this->db->select("*");
		$this->db->from('country');
		$query = $this->db->get(); 
		$result=$query->result_array(); 
		return $result;
    }
	function city($id){
		$this->db->select("*");
		$this->db->from('city');
		$this->db->where('country',$id);
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
	}
	function city1(){   // used at the update file, "city" select-box to select default value
		$this->db->select("*");
		$this->db->from('city');
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
	}
	function download($id){   
        $this->db->select("*");
		$this->db->from('registration');
		$this->db->where('id',$id);
		$query = $this->db->get(); 
		$result=$query->row();  
		return $result;   
	}
  }
?>
 