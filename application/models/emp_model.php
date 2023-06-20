<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emp_model extends CI_Model {

	public function get($id = null)
	{
        if ($id === null) {
            return $this->db->get('emp')->result();       
        }else {
            return $this->db->get_where('emp', ['emp_id' => $id])->row();
        }
	}

    public function counter() {
       return $this->db->count_all_results('emp');
  }


    public function delete($id) {
    $this->db->delete('emp', ['emp_id' => $id]);
    return $this->db->affected_rows();
   }

   public function created($data)  {
      $this->db->insert('emp',$data);
      return $this->db->affected_rows();
   }

   public function updated($data, $id)  {
    $this->db->update('emp', $data, ['emp_id' => $id]);
    return $this->db->affected_rows();
 }
}
