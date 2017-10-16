<?php
   
   class Formc extends CI_Controller {
   	   function __construct() {
	 		parent::__construct();
			$this->load->model('formm');
			$this->load->helper(array('form', 'url')); 
			$this->load->helper('path_helper');
			$this->load->library('Form_validation');
			$this->load->library('Image_lib');
			$this->load->helper('file');
			//$this->load->library('session');
		
	   }
	   public function index(){
	   	  //$up = $this->session->flashdata('item1');
	   	  $image="<img src='http://localhost/uploads/assassin.jpg' height='50' width='100'>";
		  //$data['image'] = $image;
		  //$image=" <img src='http://localhost/uploads/$up'> ";
		  $data['image'] = $image;	
		  
	   	  $query = $this->formm->database();  
		  $data['USER'] =  $query;  
		  $this->load->view('tablev', $data); 
		  
	   }
	   public function get_email_id(){
	   	//print_r($_POST);die();
	   	$this->load->model('update_textbox');
		$this->update_textbox->update_query($_POST);
	   }
	   function adduser(){
	   	$data['query']=$this->formm->country();
	   	$this->load->view('formv',$data);
	   }
      	public function addform() {   			 
         $this->form_validation->set_rules('name', 'Name', 'required|min_length[5]|max_length[15]'); 
		 $this->form_validation->set_rules('email', 'Email', 'required');
		 $this->form_validation->set_rules('number', 'Number', 'required|min_length[1]|max_length[15]');
		 
        if($this->form_validation->run() == FALSE) {  
         	$this->load->view('formv'); 
         } 
         else {
         	            $up=$_FILES['upload']['name'];
			 
			 			$fn1 = pathinfo($up, PATHINFO_FILENAME);
			 			$file_name1= preg_replace('/[^A-Za-z0-9]/', "", $fn1);
						$ext1 = pathinfo($up, PATHINFO_EXTENSION);
						$newup=$file_name1.".".$ext1;
 
						$up1=$_FILES['upload']['type'];	
						$up2=$_FILES['upload']['size'];
						$up3=$_FILES['upload']['tmp_name'];

				 	$config['upload_path']   = '/opt/lampp/htdocs/uploads/'; 
		         	$config['allowed_types'] = 'gif|jpg|png|jpeg';  
		         	$config['max_size']      = 10000; 
					
			         $filename=$config['upload_path'].$newup;
					 
					 $loop=0;
					 $i=1;
					 	$ext = pathinfo($newup, PATHINFO_EXTENSION);
						$fn = pathinfo($newup, PATHINFO_FILENAME);

					 	do{
						 	if(file_exists($filename)){
								$filename=$fn."-".$i;
								$newup=$filename.".".$ext;	
								//echo $up; die();							
								$filename=$config['upload_path'].$newup;								
								$i++;
						 	}
						 	else{
						 		$config['file_name']=$newup;
								$loop=1;
						 	}
						}while($loop==0);

					 	$this->load->library('upload', $config);						
		         		$this->upload->do_upload('upload');
					   
					$data = array(
						'name' => $this->input->post('name'),   
						'email' => $this->input->post('email'),
						'number' => $this->input->post('number'),
						'country' => $this->input->post('country'),
						'city' => $this->input->post('city'),
						'upload' => $newup
						);
						
						$this->formm->form_insert($data); 
					 	    
					 	        
					  // header("location:".base_url()."index.php/formc");
					  redirect('formc','refresh');
			 }
      }
      function country()
	  {
	  	$this->load->view('countryv');
	  }
	  function countryinsert(){
	   $this->form_validation->set_rules('countryname', 'Country', 'required|min_length[3]|max_length[15]');
	  	if($this->form_validation->run() == FALSE) {  
         	$this->load->view('countryv'); 
         } 
         else { 
			$data = array(
					    'name' => $this->input->post('countryname')
					);
					
			$this->formm->country_insert($data); 
					 	       
			redirect('formc/adduser');
		 }	 
	  }
      function city()
	  {
	  	$data['query']=$this->formm->country(); 
	  	$this->load->view('cityv',$data);
	  }	  
      function cityinsert(){
       $this->form_validation->set_rules('cityname', 'City', 'required|min_length[3]|max_length[15]');
	  	if($this->form_validation->run()==FALSE) {  
         	$this->load->view('cityv'); 
         } 
         else { 	 
			$data = array(
				        'country' => $this->input->post('country'),
						'city' => $this->input->post('cityname')
					);
			$this->formm->city_insert($data); 
					 	       
			redirect('formc/adduser');
		 }	 
	  }
	  function delete($id=""){ 
		   $this->formm->form_delete($id);
		   header("location:".base_url()."index.php/formc"); 		 
	  }
	  function upview($id){
	  	    $data['query']=$this->formm->country(); 
			$data['query1']=$this->formm->city1();
			$data['result']=$this->formm->up_form_view($id); 
			$this->load->view('upformv',$data);
	  }
      function update($id){
      	
		  			 $up=$_FILES['upload1']['name'];
					 
					 $fn1 = pathinfo($up, PATHINFO_FILENAME);
			 		 $file_name1= preg_replace('/[^A-Za-z0-9]/', "", $fn1);
					 $ext1 = pathinfo($up, PATHINFO_EXTENSION);
					 $newup=$file_name1.".".$ext1;
					 
        			 $config['upload_path']   = '/opt/lampp/htdocs/uploads/'; 
			         $config['allowed_types'] = '*'; 
			         $config['max_size']      = 10000;
			         $config['overwrite'] = true;   
					 
					 $filename=$config['upload_path'].$newup;
					 
					 $loop=0;
					 $i=1;
					 	$ext = pathinfo($newup, PATHINFO_EXTENSION);
						$fn = pathinfo($newup, PATHINFO_FILENAME);

					 	do{
						 	if(file_exists($filename)){
								$filename=$fn."-".$i;
								$newup=$filename.".".$ext;	
								//echo $up; die();							
								$filename=$config['upload_path'].$newup;								
								$i++;
						 	}
						 	else{
						 		$config['file_name']=$newup;
								$loop=1;
						 	}
						}while($loop==0);
					 
			         $this->load->library('upload', $config);						
			         $this->upload->do_upload('upload1');
		     			
        	$data1 = array(
        			'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'number' => $this->input->post('number'),
					'country' => $this->input->post('country'),
					'city' => $this->input->post('city'),
					'upload' => $newup
					);

					$this->formm->form_update($data1,$id); 
					
					header("location:".base_url()."index.php/formc");
      }
	  function ajax()
		{
			$cities['id1'] = $id = $this->input->post('id');
			$cities['query'] = $query2 = $this->formm->city($id);
			//print_r($id); die();
    		$this->load->view('cities',$cities);
		}
		public function plaintext($id) {
			$this->load->helper('download');
			$data['download']=$this->formm->download($id);
			//$json = json_encode($data);
			foreach($data as $d){
				$body = "Id is : ".$d->id.
				        "\nName is : ".$d->name.
				        "\nEmail is".$d->email.
				        "\nMobile-no is :".$d->number.
				        "\nCountry is :".$d->country.
				        "\nCity is :".$d->city.
				        "\nUploaded file is :".$d->upload ;
						
				$name = $d->name."-".$d->id.'.txt';
				force_download($name,$body);
				
			/*-->	$load=array(
					 "Id is ".$d->id,
					 "\nName is ".$d->name,
					 "\nEmail is ".$d->email,
					 "\nNumber is ".$d->number,
					 "\nCountry is ".$d->country,
					 "\nCity is ".$d->city,
					 "\nUploaded file is ".$d->upload
					 );
				*/	 
					 
					 //echo $load[0];
				//$arrlength = count($load);
				//for($x = 0; $x < $arrlength; $x++) {
    				//echo $load[$x]; } die;	 
				//$data = file_get_contents("/formc.php");
				
				//-->  $name = 'filedownload.txt';
				//$data1=file_put_contents($name, print_r($load));
				//-->  force_download($name,print($load[0]),print($load[1]),print($load[2]),print($load[3]),print($load[4]),print($load[5]),print($load[6]));
				
			}
		}
   }
?>
