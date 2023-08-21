<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_aplikasi extends CI_Model
{
    public function tot_anggota()
    {
        $query = $this->db->query("
        select count(nik) as total_ang 
        from tbl_user 
        where id_level = '3'
        ");
        return $query;
    }
    public function tot_pegawai()
    {
        $query = $this->db->query("
        select count(nik) as total_pgw 
        from tbl_user 
        where id_level = '2'
        ");
        return $query;
    }
    public function tot_admin()
    {
        $query = $this->db->query("
        select count(nik) as total_adm 
        from tbl_user 
        where id_level = '1'
        ");
        return $query;
    }
    public function tot_simpanan()
    {
        $query = $this->db->query("
        select sum(jumlah) as total_simpanan 
        from simpanan where status = 200
        ");
        return $query;
    }
    public function tot_angsuran()
    {
        $query = $this->db->query("
        select sum(nilai) as total_angsuran 
        from angsuran where status = 200
        ");
        return $query;
    }
    public function tot_angsuran_ang($id)
    {
        $query = $this->db->query("
        select sum(nilai) as total_angsuran_ang 
        from angsuran where id_user = " . $id . " and status = 200
        ");
        return $query;
    }
    public function tot_simpanan_ang($id)
    {
        $query = $this->db->query("
        select sum(jumlah) as total_simpanan_ang 
        from simpanan where id_user = " . $id . " and status = 200
        ");
        return $query;
    }
}
