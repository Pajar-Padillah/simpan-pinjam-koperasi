<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function user_data()
    {
        $data['title'] = "Data Admin";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $nik = $this->input->post('nik');
        $username = $this->input->post('username');

        // $cek = $this->Mod_user->cekUsername($username);
        $cek = $this->db->query("SELECT * FROM tbl_user WHERE nik = '$nik' or username= '$username'");
        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error_nik', 'error_nik');
            redirect(base_url('admin/user_data'));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'alamat' => $this->input->post('alamat'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'alamat' => $this->input->post('alamat'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'alamat' => $this->input->post('alamat'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'alamat' => $this->input->post('alamat'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'tlp'  => $this->input->post('tlp'),
                        'alamat' => $this->input->post('alamat'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tlp'  => $this->input->post('tlp'),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }

    public function ketua()
    {
        $data['title'] = "Data Ketua";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['pegawai'] = $this->Mod_admin->pegawai()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/pegawai', $data);
    }
    public function insert_pegawai()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $nik = $this->input->post('nik');
        $username = $this->input->post('username');
        $cek = $this->db->query("SELECT * FROM tbl_user WHERE nik = '$nik' or username= '$username'");
        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error_nik', 'error_nik');
            redirect(base_url('admin/pegawai'));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/ketua');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/ketua');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_pegawai()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/ketua');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/ketua');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/ketua');
            // echo json_encode(array("status" => TRUE));
        }
    }

    public function del_pegawai()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('swal', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/ketua');
    }
    public function anggota()
    {
        $data['title'] = "Data Anggota";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/anggota', $data);
    }
    public function insert_anggota()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $nik = $this->input->post('nik');
        $username = $this->input->post('username');
        $cek = $this->db->query("SELECT * FROM tbl_user WHERE nik = '$nik' or username= '$username'");
        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error_nik', 'error_nik');
            redirect(base_url('admin/anggota'));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'alamat' => $this->input->post('alamat'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        }
    }
    public function update_anggota()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),

                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'nik' => $this->input->post('nik'),
                        'alamat' => $this->input->post('alamat'),
                        'full_name' => $this->input->post('full_name'),
                        'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/anggota');
                // echo json_encode(array("status" => TRUE));
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'nik' => $this->input->post('nik'),
                    'alamat' => $this->input->post('alamat'),
                    'full_name' => $this->input->post('full_name'),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/anggota');
            // echo json_encode(array("status" => TRUE));
        }
    }
    public function del_anggota()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/anggota');
    }

    public function simpanan()
    {
        $data['title'] = "Simpanan Data";

        $data['user_level'] = $this->Mod_user->userlevel();
        $data['anggota'] = $this->Mod_admin->anggota()->result();

        // dead($nik);
        $this->template->load('layoutbackend', 'admin/simpanan', $data);
    }
    public function tambah_simpanan($id_user)
    {
        $data['title'] = "Simpanan Data";

        $data['simpanan'] = $this->Mod_user->getnik($id_user)->row_array();
        // dead($data['simpanan']);
        $this->template->load('layoutbackend', 'admin/tambah_simpanan', $data);
    }
    public function insert_simpanan()
    {
        // var_dump($this->input->post('username'));

        $save  = array(
            'id' => rand(00000, 99999),
            'id_user' => $this->input->post('id_user'),
            'nik' => $this->input->post('nik'),
            'status' => "200",
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->insertSimpanan("simpanan", $save);
        redirect('admin/simpanan');
        // echo json_encode(array("status" => TRUE));
    }
    public function update_simpanan()
    {
        // var_dump($this->input->post('username'));
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $save  = array(
            'nik' => $nik,
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->updateSimpanan($id, $save);
        redirect('admin/detail_simpanan/' . $nik . '');
        // echo json_encode(array("status" => TRUE));
    }
    public function delete($id)
    {
        $this->Mod_user->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function del_simpanan($nik)
    {
        // dead($nik);
        $id = $this->input->get('id');
        $this->db->delete('simpanan', array('id' => $id));

        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/detail_simpanan/' . $nik . '');
    }


    public function detail_simpanan($id_user)
    {
        $data['title'] = "Detail Simpanan Data";

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($id_user)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id_user)->row_array();
        // dead($data['jumlah']);
        $this->template->load('layoutbackend', 'admin/detail_simpanan', $data);
    }

    public function pinjaman()
    {
        $data['title'] = "Pinjaman Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();
        $data['pinjaman'] = $this->Mod_admin->pinjaman()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/pinjaman', $data);
    }
    public function insert_pinjaman()
    {
        $save  = array(
            'id' => rand(0000, 9999),
            'id_user' => $this->input->post('id_user'),
            'no_pinjaman' => 'ANG' . rand(000, 999),
            'jumlah' => $this->input->post('jumlah'),
            'lama' => $this->input->post('lama'),
            'bunga' => $this->input->post('bunga'),
            'tanggal' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->insertpinjaman("pinjaman", $save);
        redirect('admin/pinjaman');
    }
    public function update_pinjaman()
    {
        // var_dump($this->input->post('username'));
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'id_user' => $this->input->post('id_user'),
            'no_pinjaman' => $this->input->post('no_pinjaman'),
            'jumlah' => $this->input->post('jumlah'),
            'lama' => $this->input->post('lama'),
            'bunga' => $this->input->post('bunga'),
            'tanggal' => date("Y-m-d H:i:s"),

        );
        // dead($save);
        $this->Mod_user->updatepinjaman($id, $save);
        redirect('admin/pinjaman');
        // echo json_encode(array("status" => TRUE));
    }
    public function delete_pinjaman($id)
    {
        $this->Mod_user->delete_pinjaman($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function angsuran()
    {
        $data['title'] = "Angsuran Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();
        $data['angsuran'] = $this->Mod_admin->angsuran()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/angsuran', $data);
    }
    public function list_angsuran()
    {
        $data['title'] = "List Angsuran Data";
        $data['nama'] = $this->Mod_admin->nama_peminjam()->result();
        $data['list_angsuran'] = $this->Mod_admin->pinjamanacc()->result();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/list_angsuran', $data);
    }

    public function tambah_angsuran($id)
    {

        $data['title'] = "Tambah Angsuran Data";
        // $data['lama'] = ['6', '10', '12'];
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_angsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        $data['pinjaman'] = $this->Mod_admin->pinjaman_ang($id)->row();
        // $angsuran = $data['angsuran'];
        $data['parm_lama'] = $this->Mod_admin->lama($id)->row_array();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();
        $data['jum_lama'] = $this->Mod_admin->jum_lama($id)->row_array();


        // $data['total'] = $total;
        // dead($data['jum_lama']);
        $this->template->load('layoutbackend', 'admin/tambah_angsuran', $data);
    }
    public function insert_angsuran()
    {
        $id = $this->input->post('id_pinjaman');
        $id_angsuran = 'ANG' . rand(000, 999);
        $jumlah_angsuran = $this->input->post('jumlah_angsuran[]', TRUE);

        foreach ($jumlah_angsuran as $key) { // Kita buat perulangan berdasarkan nisn sampai data terakhir
            $save[$key] =
                array(
                    'jumlah_angsuran' => $key,
                    'id' => $id_angsuran++,
                    'id_user' => $this->input->post('id_user'),
                    'no_angsuran' => $this->input->post('no_pinjaman'),
                    'id_pinjaman' => $id,
                    'nilai' => $this->input->post('nilai'),
                    'tanggal' => date("Y-m-d H:i:s"),
                    'status' => "200"
                );

            $key;
        }
        // dead($save);
        $this->Mod_admin->insertangsuran("angsuran", $save);
        redirect('admin/tambah_angsuran/' . $id . '');
        // echo json_encode(array("status" => TRUE));

    }

    public function insert_angsuran_anggota()
    {
        $id = $this->input->post('id_pinjaman');
        $jumlah_angsuran = $this->input->post('jumlah_angsuran');
        $cek = $this->db->query("SELECT id_pinjaman FROM angsuran WHERE jumlah_angsuran= '$jumlah_angsuran' and id_pinjaman = '$id'");
        if ($cek->num_rows() > 0) {
            $this->session->set_flashdata('error_angsuran', 'error_angsuran');
            redirect(base_url('admin/add_angsuran_anggota/' . $id . ''));
        } else {
            $save =
                array(
                    'jumlah_angsuran' => $jumlah_angsuran,
                    'id_user' => $this->input->post('id_user'),
                    'no_angsuran' => $this->input->post('no_pinjaman'),
                    'id_pinjaman' => $id,
                    'nilai' => $this->input->post('nilai'),
                    'tanggal' => date("Y-m-d H:i:s"),
                    'bukti_bayar' => null,
                    'status' => "100"
                );

            $this->Mod_admin->insertangsuran("angsuran", $save);
            $this->session->set_flashdata('load_bukti_bayar', 'load_bukti_bayar');
            redirect('admin/add_angsuran_anggota/' . $id . '');
        }
    }
    public function delete_angsuran($id)
    {
        $this->Mod_user->delete_angsuran($id); // Panggil fungsi delete() yang ada di SiswaModel.php
        $this->session->set_flashdata('success', 'Data Simpanan Wajib Berhasil Dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function detail_angsuran($id)
    {
        $data['title'] = "Pinjaman Data";
        $data['lama'] = ['6', '10', '12'];
        $data['nama'] = $this->Mod_admin->nama_peminjam()->row();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();

        // dead($data['lama']);
        $this->template->load('layoutbackend', 'admin/detail_angsuran', $data);
    }
    public function pinjaman_anggota()
    {
        $data['title'] = "List Pinjaman Data";
        $id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $nik = $id['nik'];
        $data['list_pinjaman'] = $this->Mod_admin->pinjaman_anggota($nik)->result();

        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/pinjaman_anggota', $data);
    }
    public function angsuran_anggota()
    {
        $data['title'] = "List Angsuran Data";
        $id = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $nik = $id['nik'];
        $data['list_angsuran'] = $this->Mod_admin->angsuran_anggotaacc($nik)->result();

        // dead($data['list_angsuran']);
        $this->template->load('layoutbackend', 'admin/angsuran_anggota', $data);
    }
    public function add_angsuran_anggota($id)
    {
        $data['title'] = "Tambah Angsuran Data";
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_angsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        $data['pinjaman'] = $this->Mod_admin->pinjaman_ang($id)->row();
        $data['parm_lama'] = $this->Mod_admin->lama($id)->row_array();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();
        $data['lama'] = $this->Mod_admin->lama_jml()->row_array();
        $data['jum_lama'] = $this->Mod_admin->jum_lama($id)->row_array();
        // dead($data['sb']);

        $this->template->load('layoutbackend', 'admin/add_angsuran_anggota', $data);
    }

    public function ajukan_angsuran()
    {
        $data['title'] = "Angsuran Data";
        $data['id_user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        // dead($data['id_user']);
        $this->template->load('layoutbackend', 'admin/ajukan_angsuran', $data);
    }

    public function ajukan_pinjaman()
    {
        $data['title'] = "Pinjaman Data";
        $data['id_user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        // dead($data['id_user']);
        $this->template->load('layoutbackend', 'admin/ajukan_pinjaman', $data);
    }

    public function insert_ajukan_pinjaman()
    {
        $id_user = $this->input->post('id_user');
        $jumlah = $this->input->post('jumlah');
        $lama = $this->input->post('lama');

        $cek_redudan = $this->db->query("SELECT * FROM pinjaman WHERE status = 'N' and jumlah = '$jumlah' and lama = '$lama' and id_user = '$id_user'");
        $cek_lunas = $this->db->query("SELECT * FROM pinjaman JOIN angsuran ON pinjaman.id = angsuran.id_pinjaman WHERE pinjaman.lama = angsuran.jumlah_angsuran and angsuran.status = '200' and pinjaman.id_user ='$id_user' and pinjaman.id = angsuran.id_pinjaman and pinjaman.status = 'Y'")->num_rows();
        $pending = $this->db->query("SELECT * FROM pinjaman WHERE status = 'N' and id_user = '$id_user'");
        if ($cek_redudan->num_rows() > 0) {
            $this->session->set_flashdata('error_pinjam', 'error_pinjam');
            redirect('admin/pinjaman_anggota');
        } else {
            if ($pending->num_rows() > 0) {
                $this->session->set_flashdata('error_pending', 'error_pending');
                redirect('admin/pinjaman_anggota');
            } else {
                $save  = array(
                    'id' => rand(0000, 9999),
                    'id_user' => $id_user,
                    'no_pinjaman' => 'ANG' . rand(000, 999),
                    'jumlah' => $jumlah,
                    'lama' => $lama,
                    'status' => "N",
                    'tanggal' => date("Y-m-d H:i:s"),

                );
                // dead($save);
                $this->Mod_user->insertpinjaman("pinjaman", $save);
                $this->session->set_flashdata('pinjaman', 'pinjaman');
                redirect('admin/pinjaman_anggota');
            }
        }
    }

    public function terima_pinjaman()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'bunga' => $this->input->post('bunga'),
            'status' => "Y",
            'tanggal' => date("Y-m-d H:i:s"),
        );
        $this->Mod_user->verifpinjaman($id, $save);
        redirect('admin/pinjaman');
    }
    public function tolak_pinjaman()
    {
        $id = $this->input->post('id');
        $save  = array(
            'id' => $id,
            'alasan' => $this->input->post('alasan'),
            'status' => "T",
            'tanggal' => date("Y-m-d H:i:s"),
        );
        $this->Mod_user->verifpinjaman($id, $save);
        redirect('admin/pinjaman');
    }
    public function acc_angsuran($status_angsuran)
    {
        $id = $this->input->post('id');
        $id_pinjaman = $this->input->post('id_pinjaman');
        $this->Mod_admin->confirmangsuran($id, $status_angsuran);
        redirect('admin/tambah_angsuran/' . $id_pinjaman . '');
    }
    public function acc_simpanan($status_simpanan)
    {
        $id = $this->input->post('id');
        $id_user = $this->input->post('id_user');
        $this->Mod_admin->confirmsimpanan($id, $status_simpanan);
        redirect('admin/detail_simpanan/' . $id_user . '');
    }

    public function uploud_bukti_angsuran()
    {
        $id = $this->input->post('id');
        $id_pinjaman = $this->input->post('id_pinjaman');

        $idd = slug($this->input->post('id'));
        $config['upload_path']   = './assets/foto/bukti/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = 'Bukti Angsuran ' . $idd . '';
        $this->upload->initialize($config);
        $this->upload->do_upload('bukti_bayar');
        $gambar = $this->upload->data();

        $bukti  =  $gambar['file_name'];

        $hasil = $this->Mod_admin->confirmbuktiangsuran($id, $bukti);
        if ($hasil == false) {
            $this->session->set_flashdata('error_input', 'error_input');
        } else {
            $this->session->set_flashdata('success_uploud', 'success_uploud');
        }
        redirect('admin/add_angsuran_anggota/' . $id_pinjaman . '');
    }
    public function uploud_bukti_simpanan()
    {
        $id = $this->input->post('id');
        $id_user = $this->session->userdata('id_user');

        $idd = slug($this->input->post('id'));
        $config['upload_path']   = './assets/foto/bukti/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = 'Bukti Simpanan ' . $idd . '';
        $this->upload->initialize($config);
        $this->upload->do_upload('bukti_bayar');
        $gambar = $this->upload->data();

        $bukti  =  $gambar['file_name'];

        $hasil = $this->Mod_admin->confirmbuktisimpanan($id, $bukti);
        if ($hasil == false) {
            $this->session->set_flashdata('error_input', 'error_input');
        } else {
            $this->session->set_flashdata('success_uploud', 'success_uploud');
        }
        redirect('admin/simpanan_anggota/' . $id_user . '');
    }

    public function simpanan_anggota()
    {
        $data['title'] = "Simpanan Data";
        $id_user = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $id_user = $id_user['id_user'];
        $data['simpanan_anggota'] = $this->Mod_user->simpanan_anggota($id_user)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id_user)->row_array();
        // dead($data['jml']);
        $this->template->load('layoutbackend', 'admin/simpanan_anggota', $data);
    }
    public function add_simpanan_anggota()
    {
        $data['title'] = "Simpanan Data";
        $id_user = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['user'] = $id_user;
        $this->template->load('layoutbackend', 'admin/add_simpanan_anggota', $data);
    }

    public function insert_simpanan_anggota()
    {
        $save  = array(
            'id' => rand(00000, 99999),
            'id_user' => $this->input->post('id_user'),
            'nik' => $this->input->post('nik'),
            'jumlah' => $this->input->post('jumlah'),
            'bukti_bayar' => null,
            'status' => '100',
            'tanggal_bayar' => date("Y-m-d H:i:s"),

        );
        $this->Mod_admin->insertsimpanan("simpanan", $save);
        $this->session->set_flashdata('load_bukti_bayar', 'load_bukti_bayar');
        redirect('admin/simpanan_anggota');
    }

    public function cetak_invoice_angsuran($id)
    {
        $data['title'] = "Angsuran Data";
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_perangsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        $data['lama'] = $this->Mod_admin->lama_jml()->result();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();

        $this->load->view('admin/cetak_invoice_angsuran', $data);
    }
    public function cetak_invoice_simpanan($id)
    {
        $data['title'] = "Simpanan Data";
        $data['simpanan_anggota'] = $this->Mod_user->persimpanan_anggota($id)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id)->row_array();

        $this->load->view('admin/cetak_invoice_simpanan', $data);
    }

    public function cetak_perangsuran($id)
    {
        $data['title'] = "Tambah Angsuran Data";
        // $data['lama'] = ['6', '10', '12'];
        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_perangsuran($id)->result();
        $data['angsuran'] = $this->Mod_admin->detail_angsuran($id)->row();
        // $angsuran = $data['angsuran'];
        $data['lama'] = $this->Mod_admin->lama_jml()->result();
        $data['sb'] = $this->Mod_admin->sdhbyr()->result();


        // $data['total'] = $total;
        // dead($data['riwayat_angsuran']);
        $this->load->view('admin/cetak_perangsuran', $data);
    }
    public function cetak_persimpanan($id)
    {
        $data['title'] = "Simpanan Data";
        $data['simpanan_anggota'] = $this->Mod_user->persimpanan_anggota($id)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($id)->row_array();
        // dead($nik);
        // $data['total'] = $total;
        // dead($data['riwayat_angsuran']);
        $this->load->view('admin/cetak_persimpanan', $data);
    }

    function laporan_angsuran()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $id_user = $_GET['id_user'];
                $ket = 'Data Angsuran dari Anggota dengan ID ' . $id_user;
                $url_cetak = 'admin/angsuranPDF1?&id_user=' . $id_user;
                $anggota = $this->Mod_user->view_angsuran_by_anggota($id_user)->result();
            } else if ($filter == '2') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Angsuran dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'admin/angsuranPDF2?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $anggota = $this->Mod_user->view_angsuran_by_date($tanggal1, $tanggal2)->result();
            }
        } else {
            $ket = 'Semua Data Angsuran';
            $url_cetak = 'admin/angsuranPDF';
            $anggota = $this->Mod_user->view_all_angsuran()->result();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['anggota'] = $anggota;
        // dead($data['anggota']);
        $data['anggota_list'] = $this->Mod_user->anggota()->result();
        // $data['tahun_ajaran'] = $this->Mod_user->tahun()->result();
        $data['title'] = 'Laporan Data Angsuran Diterima';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->template->load('layoutbackend', 'admin/laporan_angsuran', $data);
    }
    function laporan_simpanan()
    {
        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
            $filter = $_GET['filter'];
            if ($filter == '1') {
                $id_user = $_GET['id_user'];
                $ket = 'Data Simpanan dari Anggota dengan ID ' . $id_user;
                $url_cetak = 'admin/simpananPDF1?&id_user=' . $id_user;
                $anggota = $this->Mod_user->view_simpanan_by_anggota($id_user)->result();
            } else if ($filter == '2') {
                $tanggal1 = $_GET['tanggal'];
                $tanggal2 = $_GET['tanggal2'];
                $ket = 'Data Simpanan dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' - ' . date('d-m-y', strtotime($tanggal2));
                $url_cetak = 'admin/simpananPDF2?tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2 . '';
                $anggota = $this->Mod_user->view_simpanan_by_date($tanggal1, $tanggal2)->result();
            }
        } else {
            $ket = 'Semua Data Simpanan';
            $url_cetak = 'admin/simpananPDF';
            $anggota = $this->Mod_user->view_all_simpanan()->result();
        }

        $data['ket'] = $ket;
        $data['url_cetak'] = base_url($url_cetak);
        $data['anggota'] = $anggota;
        // dead($data['anggota']);
        $data['anggota_list'] = $this->Mod_user->anggota()->result();
        // $data['tahun_ajaran'] = $this->Mod_user->tahun()->result();
        $data['title'] = 'Laporan Data Simpanan';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $this->template->load('layoutbackend', 'admin/laporan_simpanan', $data);
    }

    public function angsuranPDF()
    {
        $ket = 'Semua Data Angsuran Diterima';
        $data['anggota'] = $this->Mod_user->view_all_angsuran()->result();;
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_angsuran.pdf";
        $this->pdf->load_view('admin/angsuran_pdf', $data);
    }
    public function angsuranPDF1()
    {
        $id_user = $_GET['id_user'];
        $ket = 'Data Angsuran Dengan Id ' . $id_user;

        $data['anggota'] = $this->Mod_user->view_angsuran_by_anggota($id_user)->result();
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_angsuran.pdf";
        $this->pdf->load_view('admin/angsuran_pdf', $data);
    }

    public function angsuranPDF2()
    {
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Angsuran dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        $data['anggota'] = $this->Mod_user->view_angsuran_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_angsuran.pdf";
        $this->pdf->load_view('admin/angsuran_pdf', $data);
    }

    public function simpananPDF()
    {
        $ket = 'Semua Data Simpanan Diterima';
        $data['anggota'] = $this->Mod_user->view_all_simpanan()->result();;
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_simpanan.pdf";
        $this->pdf->load_view('admin/simpanan_pdf', $data);
    }
    public function simpananPDF1()
    {
        $id_user = $_GET['id_user'];
        $ket = 'Data Simpanan Dengan Id ' . $id_user;

        $data['anggota'] = $this->Mod_user->view_simpanan_by_anggota($id_user)->result();
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_simpanan.pdf";
        $this->pdf->load_view('admin/simpanan_pdf', $data);
    }

    public function simpananPDF2()
    {
        $tanggal1 = $_GET['tanggal1'];
        $tanggal2 = $_GET['tanggal2'];
        $ket = 'Data Simpanan dari Tanggal ' . date('d-m-y', strtotime($tanggal1)) . ' s/d ' . date('d-m-y', strtotime($tanggal2));
        $data['anggota'] = $this->Mod_user->view_simpanan_by_date($tanggal1, $tanggal2)->result();
        $data['ket'] = $ket;
        $this->load->library('pdf');
        $this->pdf->set_option('isRemoteEnabled', TRUE);
        $paper_size = 'A4';
        $orientation = 'portrait';
        $this->pdf->set_paper($paper_size, $orientation);
        $this->pdf->filename = "laporan_simpanan.pdf";
        $this->pdf->load_view('admin/simpanan_pdf', $data);
    }

    public function print_simpanan($nik)
    {
        $data['ket'] = 'Semua Data Simpanan Diterima';

        $data['det_simpanan'] = $this->Mod_user->detail_simpanan($nik)->result();
        $data['jml'] = $this->Mod_admin->total_simpanan($nik)->row_array();
        $this->load->view('admin/print_simpanan', $data);
    }
    public function print_allsimpanan()
    {
        $data['ket'] = 'Semua Data Simpanan Diterima';

        $data['det_simpanan'] = $this->Mod_user->print_allsimpanan()->result();

        $this->load->view('admin/print_allsimpanan', $data);
    }

    public function cetak_angsuran_anggota($id)
    {
        $data['ket'] = 'Semua Data Angsuran Diterima';

        $data['riwayat_angsuran'] = $this->Mod_admin->riwayat_angsuran($id)->result();

        $this->load->view('admin/cetak_angsuran_anggota', $data);
    }
    public function cetak_simpanan_anggota()
    {
        $data['ket'] = 'Semua Data Angsuran Diterima';
        $id_user = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $id_user = $id_user['id_user'];
        $data['simpanan_anggota'] = $this->Mod_user->simpanan_anggota($id_user)->result();
        $this->load->view('admin/cetak_simpanan_anggota', $data);
    }
    public function cetak_pinjaman($id)
    {
        $data['cetak_pinjaman'] = $this->Mod_user->cetak_pinjaman($id)->result();
        // dead($data['cetak_pinjaman']);
        $this->load->view('admin/cetak_pinjaman', $data);
    }

    public function cetak_all_pinjaman()
    {
        $data['cetak_all_pinjaman'] = $this->Mod_user->cetak_all_pinjaman()->result();
        // dead($data['cetak_pinjaman']);
        $this->load->view('admin/cetak_all_pinjaman', $data);
    }


    public function backup()
    {

        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
