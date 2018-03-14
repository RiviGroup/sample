<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct()
    {   
        parent::__construct();
        $this->load->helper('url');
		$this->load->helper('form');
        $this->load->helper('file');
        //$this->load->helper('sendsms');
	    $this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('admin_model');
    }

	public function admin_login()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/login');
		//$this->load->view('admin/footer');
	}
	
	public function dashboard()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$array['doctors_count'] = $this->admin_model->doctors_count();
		$array['users_count'] = $this->admin_model->users_count();
		$array['appoint_ments'] = $this->admin_model->appointments_count();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function login_checkin()
	{
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	
      $row = $this->admin_model->login_checking($email,$password);
	
		
		
		if($row == true)
					 {
						
					 $sess_array = array(
                                        'firstname' => $row->admin_name,
										'lastname' => $row->admin_name,
										'user_role' =>$row->admin_type,
										'user_id'=>$row->admin_id,
									    'mobile'=>$row->admin_mobile,
										'logged_in' => TRUE
                                         );
			
                     $this->session->set_userdata($sess_array);
                    if($this->session->userdata('user_role') =='1'){
						                                            redirect('dashboard','refresh');
																	header('Content-type: text/plain'); 
																	header('Content-type: application/json');
																	echo json_encode("success") ; 
                                                                     
					 }  else if($this->session->userdata('user_role') =='2') {
																			redirect('mopderator_dashboard','refresh');
																			header('Content-type: text/plain');
																			header('Content-type: application/json');																	
																			echo json_encode("success") ; 
                    }   else if($this->session->userdata('user_role') =='3') {
																			redirect('marketing_dashboard','refresh');
																			header('Content-type: text/plain');
																			header('Content-type: application/json');																	
																			echo json_encode("success") ; 

					} else {
						                     $this->session->set_flashdata('message_login', 'Opps! Invalid login hg. Please try with valid credentials');
						                   // redirect('admin_login','refresh');
											
											
	}
		
	}
	}
	
	public function logout()
	{
		
		$this->session->sess_destroy();		
		$sess_arra = array(
                    'firstname' =>"",
                    'lastname' =>"",
                    'user_role' =>"",            
                    'user_id'=>"",
                    'mobile'=>"",
					'logged_in' => FALSE
                );  
				
		
        $this->session->unset_userdata($sess_arra); 
		$this->session->set_flashdata('message_logout', 'Successfully Logged Out');
		redirect('admin_login','refresh');
	}
	
	
	public function Appointments()
	{
		//$array['lists'] = $this->admin_model->select_menu_list();
		//$array['list'] = $this->admin_model->category_menu_list();
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$array['lists'] = $this->admin_model->Appintments_list();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/Appointments',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
		
	}
	
	public function Clinician()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['lists'] = $this->admin_model->select_clinitions();
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/cliniciations',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function Patient()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['lists'] = $this->admin_model->select_patients();
	    $array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/patients',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function payments()
	{
		//$array['lists'] = $this->admin_model->select_menu_list();
		//$array['list'] = $this->admin_model->category_menu_list();
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/payments');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function analytics()
	{
		//$array['lists'] = $this->admin_model->select_menu_list();
		//$array['list'] = $this->admin_model->category_menu_list();
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/analytics');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function reports()
	{
		//$array['lists'] = $this->admin_model->select_menu_list();
		//$array['list'] = $this->admin_model->category_menu_list();
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/zreports');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function settings()
	{
		//$array['lists'] = $this->admin_model->select_menu_list();
		//$array['list'] = $this->admin_model->category_menu_list();
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/settings');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function patient_page($id)
	{
	
		if($this->session->userdata('firstname')!= ""){
		$array['lists'] = $this->admin_model->patinet_select_page($id);	
		$array['appointment'] = $this->admin_model->patinet_appointments($id);
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/patient_profile',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
		
		
	}
	
	public function fromdateandtodatedata($id=0)
	{
		if($this->session->userdata('firstname')!= ""){
		
		$fromdate =  $this->input->post('fromdate');
		$todate =  $this->input->post('todate');
		$array['frodateandtodate'] = $this->admin_model->fromdateandtodatedata($fromdate,$todate,$id);
		
		} else {
		redirect('admin_login','refresh');	
		}
		
	}
	
	public function get_submenulist($id=0)
	{
	
	$result['lists'] = $this->admin_model->get_submenulist($id);
	echo json_encode($result);
	}
	
	public function Menu_Management()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/menu_management');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function Role_Management()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/role_management');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function User_Management()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$array['roles'] = $this->admin_model->selectrole();
		$array['lists'] = $this->admin_model->select_existing_users();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/user_management',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function createuser()
	{
		        $creat_users = array(
							    'admin_name'=>$this->input->post('name'),
							    'admin_email'=>$this->input->post('email'),
							    'admin_mobile'=>$this->input->post('mobileno'),
							    'admin_type'=>$this->input->post('usertype'),
							    'admin_password'=>rand(100000,999999),
								'admin_created_on'=>date('Y-m-d H:i:s')
							   );
		        $array['sidemenus'] = $this->admin_model->creating_user($creat_users);
				redirect('User_Management','refresh');
	}
	
	public function mobilevalidation($id=0)
	{
		
	    $result = $this->admin_model->mobilevalidation($id);
	    
		if(count($result) > 0 ){
		echo json_encode(1);
		} else {
			echo json_encode(0);
		}
		
	}
	
	public function marketing_dashboard()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function mopderator_dashboard()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function Registration()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/user_marketing_registartion');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function Referrer_Management()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['referer_type'] = $this->admin_model->select_refferer_type_group();
		$array['referer_corporate'] = $this->admin_model->select_refferer_corporate_types();
		//$array['lists'] = $this->admin_model->select_refferer_type_group();
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/referrer_management',$array);
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	
	}
	
	public function Referral_Managent()
	{
		if($this->session->userdata('firstname')!= ""){
		$array['sidemenus'] = $this->admin_model->sidemenu();
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar',$array);
		$this->load->view('admin/referral_management');
		$this->load->view('admin/footer');
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	public function referrer_add_type()
	{
		$data =array(
		             'ref_type_name' => $this->input->post('referrercategory'),
					 'ref_type_group' => $this->input->post('referrer_group'),
                     'ref_type_status'	=> 1				 
		            );
		$this->admin_model->add_referrer_type($data);			
		redirect('Referrer_Management','refresh');
	}
	
	public function select_refer_type()
	{
		$id = $this->input->post('referre_type');
	    $result['lists'] = $this->admin_model->select_refer_types($id);
	    echo json_encode($result);
		
	}
	
	public function referrer_add_registration()
	{
		$data =array(
		             'ref_corp_type' => $this->input->post('referrer_types'),
					 'ref_corp_group' => $this->input->post('selectgroup'),
                     'ref_corp_name' => $this->input->post('referrername'),				 
                     'ref_corp_location' => $this->input->post('referrer_location'),				 
                     'ref_corp_code' => $this->input->post('referrer_code'),			 
                     'ref_corp_status' => 1				 
		            );
		$this->admin_model->add_referr_reg($data);			
		redirect('Referrer_Management','refresh');
	}
	
	public function edit_referrer($id=0)
	{
		$array['lists'] = $this->admin_model->edit_referrer_data($id);
		echo json_encode($array);
		
	}
	
	public function edit_corp_referrer($id=0)
	{
		$array['listss'] = $this->admin_model->edit_corp_referrer_data($id);
		echo json_encode($array);
		
	}
	
	public function referrer_update_type()
	{
		
	    $id=$this->input->post('referupdateid');
		
		$data =array(
		             'ref_type_name' => $this->input->post('referrereditcategory'),
					 'ref_type_group' => $this->input->post('referreredit_group')
                    );
					
			
		$this->admin_model->update_referrer_data($data,$id);
		redirect('Referrer_Management','refresh');
	}
	
	public function advanced_searching()
	{
		if($this->session->userdata('firstname')!= ""){
		$fromdate = $this->input->post('fromdate');
		$todate =  $this->input->post('todate');
	    $advanced_seaches =  $this->input->post('advanced_search');
	    $id =  $this->input->post('id');
	    $array['advanced_searches'] = $this->admin_model->advanced_searching($fromdate,$todate,$advanced_seaches,$id);
		//exit;
		echo json_encode($array);
		} else {
		redirect('admin_login','refresh');	
		}
	}
	
	function referrer_edit_refer()
	{
		$id=$this->input->post('edit_corp_referupdateid');
		$data =array(
		             'ref_corp_type' => $this->input->post('edit_referrer_types'),
					 'ref_corp_group' => $this->input->post('edit_referrer_group'),
                     'ref_corp_name' => $this->input->post('edit_referrername'),				 
                     'ref_corp_location' => $this->input->post('edit_referrer_location'),				 
                     'ref_corp_code' => $this->input->post('edit_referrer_code'),			 
                     'ref_corp_status' => 1				 
		            );
		$this->admin_model->update_edtr_corp($data,$id);			
		redirect('Referrer_Management','refresh');
		
	}
	
	
	
	}
	?>