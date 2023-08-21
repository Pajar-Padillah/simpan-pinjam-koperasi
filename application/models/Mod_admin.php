<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }
    public function admin()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '1' order by id_user desc
        ");
        return $query;
    }
    public function pegawai()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '2' order by id_user desc
        ");
        return $query;
    }

    public function anggota()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3' order by id_user desc
        ");
        return $query;
    }
    public function total_simpanan($id_user)
    {
        $query = $this->db->query("
         select sum(jumlah) as jumlah
        from simpanan
        where id_user = " . $id_user . " and status = 200
        ");
        return $query;
    }
    public function pinjaman()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        order by p.tanggal desc
        ");
        return $query;
    }
    public function pinjamanacc()
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where p.status = 'Y'
        order by p.tanggal desc
        ");
        return $query;
    }
    public function nama_peminjam()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '3'
        ");
        return $query;
    }
    public function angsuran()
    {
        $query = $this->db->query("
        select a.*, tu.nik, tu.full_name, p.no_pinjaman, p.jumlah, p.lama, .p.bunga, sum(a.jumlah_angsuran) as total_angsuran
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        ");
        return $query;
    }
    public function detail_angsuran($id)
    {

        $query = $this->db->query("
        select a.id, a.id_pinjaman, a.id_user, a.no_angsuran, a.jumlah_angsuran, a.nilai, a.tanggal, a.status, tu.nik, tu.full_name, sum(a.nilai) as total_angsuran, p.id, p.id_user, p.no_pinjaman, p.jumlah, p.tanggal, p.lama, p.bunga
        from angsuran a
        left join tbl_user tu
        on a.id_user=tu.id_user
        left join pinjaman p
        on a.id_pinjaman=p.id
        where p.id = " . $id . "
        ");
        return $query;
    }
    public function riwayat_angsuran($id)
    {
        $query = $this->db->query("
        select *
        from angsuran
        where id_pinjaman = " . $id . "
        order by jumlah_angsuran asc
        ");
        return $query;
    }
    public function riwayat_perangsuran($id)
    {
        $query = $this->db->query("
        select *
        from angsuran
        where id = " . $id . "
        order by jumlah_angsuran asc
        ");
        return $query;
    }
    public function lama($id)
    {
        $query = $this->db->query("
        select lama
        from pinjaman where id = " . $id . "
        ");
        return $query;
    }
    public function lama_jml()
    {
        $query = $this->db->query("
        select *
        from lama 
        ");
        return $query;
    }
    function insertangsuran($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }
    function insertsimpanan($tabel, $data)
    {
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }
    public function save_batch($data)
    {
        return $this->db->insert_batch('angsuran', $data);
    }
    public function confirmbuktiangsuran($id, $bukti)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE angsuran SET bukti_bayar='$bukti' WHERE id='$id'");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }
    public function confirmbuktisimpanan($id, $bukti)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE simpanan SET bukti_bayar='$bukti' WHERE id='$id'");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }
    public function confirmangsuran($id, $status_angsuran)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE angsuran SET status='$status_angsuran' WHERE id='$id'");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }
    public function confirmsimpanan($id, $status_simpanan)
    {
        $this->db->trans_start();
        $this->db->query("UPDATE simpanan SET status='$status_simpanan' WHERE id='$id'");
        $this->db->trans_complete();
        if ($this->db->trans_status() == true)
            return true;
        else
            return false;
    }
    public function sdhbyr()
    {
        $query = $this->db->query("
       select jumlah_angsuran, no_angsuran
        from angsuran 
        where no_angsuran = 'AN0010'
        ");
        return $query;
    }
    public function angsuran_anggota($nik)
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where tu.nik = " . $nik . "
        order by p.status desc
        ");
        return $query;
    }

    public function pinjaman_anggota($nik)
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where tu.nik = " . $nik . "
        order by p.tanggal desc
        ");
        return $query;
    }

    public function angsuran_anggotaacc($nik)
    {
        $query = $this->db->query("
        select tu.full_name, tu.image, tu.nik, tu.image, p.*
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where p.status = 'Y' and tu.nik = " . $nik . "
        order by p.tanggal desc
        ");
        return $query;
    }

    public function pinjaman_ang($id)
    {
        $query = $this->db->query("
        select * 
        from pinjaman p
        left join tbl_user tu
        on p.id_user=tu.id_user
        where id = " . $id . "
        ");
        return $query;
    }

    public function jum_lama($id)
    {
        $query = $this->db->query("
        select count(*) as total from angsuran
        where id_pinjaman = " . $id . "
        ");
        return $query;
    }
}
