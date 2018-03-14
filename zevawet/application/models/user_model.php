<?php
Class user_model extends CI_Model
{
	 public function registration($user_name)
 {
   $this->db->insert('ecom_users_tbl', $user_name);
   $last_id = $this->db->insert_id();
 }
 
     public function select_menu()
	{
		$this->db->select('*');
        $this->db->from('ecom_menu_tbl');
        $query = $this->db->get();
		return $query->result();
	}
}
 ?>