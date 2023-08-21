<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_user extends CI_Model
{

    var $table = 'tbl_user';
    var $column_order = array('username', 'full_name', 'id_level', 'image', 'is_active');
    var $column_search = array('username', 'full_name', 'id_level', 'is_active');
    var $order = array('id_user' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db->select('a.*,b.nama_level');
        $this->db->join('tbl_userlevel b', 'a.id_level=b.id_level');
        $this->db->from('tbl_user a');
        $where = "a.id_level='1' or a.id_level='2'";
        $this->db->where($where);



        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {

        $this->db->from('tbl_user');
        return $this->db->count_all_results();
    }

    function view_user($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->get('tbl_user');
    }

    function getAll()
    {
        $this->db->select('a.*,b.nama_level');
        $this->db->join('tbl_userlevel b', 'a.id_level = b.id_level');
        $this->db->order_by('a.id_user desc');
        return $this->db->get('tbl_user a');
    }

    function cekUsername($username)
    {
        $this->db->where("username", $username);
        return $this->db->get("tbl_user");
    }

    function insertUser($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    function getUser($id)
    {
        $this->db->where("id_user", $id);
        return $this->db->get("tbl_user a")->row();
    }

    function updateUser($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }


    function deleteUsers($id, $table)
    {
        $this->db->where('id_user', $id);
        $this->db->delete($table);
    }

    function userlevel()
    {
        return $this->db->order_by('id_level ASC')
            ->get('tbl_userlevel')
            ->result();
    }

    function getImage($id)
    {
        $this->db->select('image');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $id);
        return $this->db->get();
    }

    function reset_pass($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }
    public function gettotal($id)
    {
        $query = $this->db->query("
		select count(username) as total_siswa 
		from tbl_user 
		where id_level = " . $id . "
		");
        return $query;
    }
    function insertSimpanan($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }
    function updateSimpanan($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('simpanan', $data);
    }
    public function getnik($id_user)
    {
        $query = $this->db->query("
		select *
		from tbl_user 
		where id_user = " . $id_user . "
		");
        return $query;
    }
    public function detail_simpanan($id_user)
    {
        $query = $this->db->query("
		select *
		from simpanan 
		where id_user = " . $id_user . "  
        order by tanggal_bayar desc
		");
        return $query;
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('simpanan'); // Untuk mengeksekusi perintah delete data
    }
    function insertpinjaman($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }
    function updatepinjaman($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pinjaman', $data);
    }
    public function delete_pinjaman($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pinjaman'); // Untuk mengeksekusi perintah delete data
    }
    public function delete_angsuran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('angsuran'); // Untuk mengeksekusi perintah delete data
    }
    function verifpinjaman($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pinjaman', $data);
    }
    public function simpanan_anggota($id_user)
    {
        $query = $this->db->query("
		select tu.full_name, s.* 
        from simpanan s
         join tbl_user tu
        on tu.id_user=s.id_user
         where s.id_user = " . $id_user . "
           order by tanggal_bayar desc
		");
        return $query;
    }
    public function persimpanan_anggota($id)
    {
        $query = $this->db->query("
		select s.*, tu.*
		from simpanan s
        left join tbl_user tu
        on s.id_user=tu.id_user
		where s.id = " . $id . "
      
		");
        return $query;
    }

    public function anggota()
    {
        $query = $this->db->query("
		select * from tbl_user where id_level = 3
		");
        return $query;
    }
    public function view_all_angsuran()
    {
        $query = $this->db->query("
		select a.*, tu.full_name 
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        order by a.status desc
		");
        return $query;
    }
    public function view_angsuran_by_date($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('angsuran');
        $this->db->join('tbl_user', 'angsuran.id_user = tbl_user.id_user');
        $this->db->where('status = 200');
        $this->db->where('tanggal BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tanggal');
        return $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }

    public function view_angsuran_by_anggota($id)
    {
        $query = $this->db->query("
		select a.*, tu.full_name 
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        where a.id_user = " . $id . " and status = 200
        order by a.no_angsuran asc
		");
        return $query;
    }

    public function view_all_simpanan()
    {
        $query = $this->db->query("
		select a.*, tu.full_name 
        from simpanan a
        left join tbl_user tu
        on a.id_user=tu.id_user
        order by a.status desc
		");
        return $query;
    }
    public function view_simpanan_by_date($tanggal1, $tanggal2)
    {
        $this->db->select('*');
        $this->db->from('simpanan');
        $this->db->join('tbl_user', 'simpanan.id_user = tbl_user.id_user');
        $this->db->where('status = 200');
        $this->db->where('tanggal_bayar BETWEEN"' . date('Y-m-d', strtotime($tanggal1)) . '"and"' . date('Y-m-d', strtotime($tanggal2)) . '"');
        $this->db->order_by('tanggal_bayar');
        return $this->db->get(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter  
    }

    public function view_simpanan_by_anggota($id)
    {
        $query = $this->db->query("
		select a.*, tu.full_name 
        from simpanan a
        left join tbl_user tu
        on a.id_user=tu.id_user
        where a.id_user = " . $id . " and status = 200
        order by a.tanggal_bayar asc
		");
        return $query;
    }

    public function print_allsimpanan()
    {
        $query = $this->db->query("
		select s.*, tu.full_name
        from simpanan s
        left join tbl_user tu
        on s.nik=tu.nik
		");
        return $query;
    }
    public function cetak_pinjaman($id)
    {
        $query = $this->db->query("
       select tu.full_name, tu.image, tu.nik, tu.image, p.*
       from pinjaman p
       left join tbl_user tu
       on p.id_user=tu.id_user
        where id = " . $id . "
        ");
        return $query;
    }
    public function cetak_all_pinjaman()
    {
        $query = $this->db->query("
   select tu.full_name, tu.image, tu.nik, tu.image, p.*
   from pinjaman p
   left join tbl_user tu
   on p.id_user=tu.id_user
    ");
        return $query;
    }
}
