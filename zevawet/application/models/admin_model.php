<?php
Class admin_model extends CI_Model
{
	
	public function sidemenu()
	{
		$this->db->select('*');
		$this->db->from('crm_menu');
		//$this->db->group_by('crm_menuname');
		$this->db->where('crm_menusstatus',"1");
		$this->db->order_by('crm_menuname','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	
    public function login_checking($email,$password)
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->where('admin_mobile', $email);
		$this->db->where('admin_password', $password);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function select_patients()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('user_created_on','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function select_clinitions()
	{
		$this->db->select('*');
		$this->db->from('doctors');
		$query = $this->db->get();
		return $query->result();
		
	}

    public function patinet_select_page($id)
	{
        $this->db->select('u.*,s.*');
		$this->db->from('users u,states s');
		$this->db->where('s.state_id=u.user_state');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->row();
    }

    public function patinet_appointments($id)
	{
        $this->db->select('a.*,d.*');
		$this->db->from('appointments a,doctors d');
		$this->db->where('a.appointment_doctor_id=d.doctor_id');
		$this->db->where('appointment_user_id',$id);
		$query = $this->db->get();
		return $query->result();
    }

    public function fromdateandtodatedata($fromdate,$todate,$id)
	{
        $this->db->select('a.*,d.*');
		$this->db->from('appointments a,doctors d');
		$this->db->where('a.appointment_doctor_id=d.doctor_id');
		$this->db->where('a.appointment_user_id',$id);
		$this->db->where('DATE(a.appointment_date) >=',$fromdate);
        $this->db->where('DATE(a.appointment_date) <=',$todate);
        $this->db->order_by('a.appointment_id','ASC');
		$query = $this->db->get();
		return $query->result(); 
    }

    public function get_submenulist($menu)
	{
        $this->db->select('crm_menuname,crm_submenu');
		$this->db->from('crm_menu');
        $this->db->where('crm_menuname',$menu);
        $this->db->order_by('crm_submenu','ASC');
		$query = $this->db->get();
		return $query->result();
    }	
	
	public function selectrole()
	{
		$this->db->select('*');
		$this->db->from('crm_rolemaster');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function doctors_count()
	{
		$this->db->select('count(*) as doctor_cnt');
		$this->db->from('doctors');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function users_count()
	{
		$this->db->select('count(*) as user_cnt');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->row();
	}
	
	public function appointments_count()
	{
		$this->db->select('count(*) as appointment_cnt');
		$this->db->from('appointments');
		$query = $this->db->get();
		return $query->row();
	}
	
	
	
	public function creating_user($user)
	{
	    $this->db->insert('admins',$user);
		
	}
	
	public function add_referrer_type($data)
	{
		 $this->db->insert('referrer_type',$data);
	}
	
	public function select_existing_users()
	{
		$this->db->select('*');
		$this->db->from('admins');
		$this->db->order_by('DATE(admin_created_on)','DESC');
		$query = $this->db->get();
		return $query->result();
    }
	
	public function mobilevalidation($mobileno)
	{
		$this->db->select('admin_mobile');
		$this->db->from('admins');
        $this->db->where('admin_mobile',$mobileno);
        $query = $this->db->get();
		return $query->row();
	}
	
	public function Appintments_list()
	{
		$this->db->select('a.*,u.*,d.*');
		$this->db->from('appointments a,users u,doctors d');
        //$this->db->where('admin_mobile',$mobileno);
		$this->db->where('a.appointment_user_id = u.user_id');
	    $this->db->where('a.appointment_doctor_id = d.doctor_id');
		$this->db->order_by('a.appointment_id','desc
		');
        $query = $this->db->get();
		return $query->result();
	}
	
	public function select_refferer_type_group()
	{
		$this->db->select('*');
		$this->db->from('referrer_type');
        $query = $this->db->get();
		return $query->result();
	}
	
	public function select_refer_types($id)
	{
		$this->db->select('*');
		$this->db->from('referrer_type');
		$this->db->where('ref_type_id',$id);
		$this->db->where('ref_type_status','1');
        $query = $this->db->get();
		return $query->result();
	}
	
	public function add_referr_reg($data)
	{
		$this->db->insert('referrer_corp',$data);
		
	}
	
	public function select_refferer_corporate_types()
	{
		$this->db->select('rt.*,rc.*');
		$this->db->from('referrer_type rt,referrer_corp rc');
		$this->db->where('rc.ref_corp_type=rt.ref_type_id');
		$this->db->where('rc.ref_corp_status',"1");
        $query = $this->db->get();
		return $query->result();
	}
	
	public function edit_referrer_data($id)
	{
		$this->db->select('*');
		$this->db->from('referrer_type');
		$this->db->where('ref_type_id',$id);
        $query = $this->db->get();
		return $query->row();
		
		
	}
	
	public function update_referrer_data($data,$id)
	{
		$this->db->where('ref_type_id',$id);
		$this->db->update('referrer_type',$data);
		
	}
	
	public function edit_corp_referrer_data($id)
	{
		$this->db->select('rt.*,rc.*');
		$this->db->from('referrer_type rt,referrer_corp rc');
		$this->db->where('rc.ref_corp_type=rt.ref_type_id');
		$this->db->where('rc.ref_corp_status','1');
		$this->db->where('rc.ref_corp_id',$id);
        $query = $this->db->get();
		return $query->row();
	}
	
	public function update_edtr_corp($data,$id)
	{
		$this->db->where('ref_corp_id',$id);
		$this->db->update('referrer_corp',$data);
	}
	
	public function advanced_searching($fromdate,$todate,$text,$id)
	{
		
		$this->db->select('a.*,u.*,d.*');
		$this->db->from('appointments a,users u,doctors d');
		if($id == '1'){
		$this->db->where('a.appointment_id',$text);
        } else if($id == '2'){
		$this->db->where('a.appointment_user_id',$text);
	    } else if($id == '3'){
	    $this->db->where('a.appointment_doctor_id',$text); 
	    } else if($id == '4'){
	    $this->db->where('a.appointment_status',$text);
		} else if($id == '5'){
		$this->db->where('u.user_firstname',ucfirst($text));
		} else if($id == '6'){
		$this->db->where('d.doctor_firstname',ucfirst($text));
		}
		$this->db->where('a.appointment_user_id = u.user_id');
	    $this->db->where('a.appointment_doctor_id = d.doctor_id');
		if($fromdate !="" && $todate != ""){
		$this->db->where('DATE(appointment_date) >=',$fromdate);
        $this->db->where('DATE(appointment_date) <=',$todate);
		}
		$this->db->order_by('a.appointment_id','ASC');
        $query = $this->db->get();
		//return $this->db->last_query(); 
		return $query->result();
		
	}
	
	
}
 ?>