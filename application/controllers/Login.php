<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Mod_login'));
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in == TRUE) {
            redirect('dashboard/index');
        } else {
            $this->load->view('v_login');
        }
    } //end function index

    function login()
    {
        //cek username database
        $username = anti_injection($this->input->post('username'));

        if ($this->Mod_login->check_db($username)->num_rows() == 1) {
            $db = $this->Mod_login->check_db($username)->row();

            if (hash_verified(anti_injection($this->input->post('password')), $db->password)) {
                //cek username dan password yg ada di database
                $userdata = array(
                    'id_user'  => $db->id_user,
                    'username'    => ucfirst($db->username),
                    'full_name'   => ucfirst($db->full_name),
                    'password'    => $db->password,
                    'id_level'    => $db->id_level,
                    'nik'    => $db->nik,
                    'image'       => $db->image,
                    'logged_in'    => TRUE
                );
                $this->session->set_userdata($userdata);
                $this->session->set_flashdata('success_login', 'success_login');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('loggin_err_pass', 'loggin_err_pass');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('loggin_err_no_user', 'loggin_err_no_user');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->driver('cache');
        $this->cache->clean();
        $this->session->set_flashdata('success_log_out', 'success_log_out');
        redirect('login');
    }

    // private function _validate()
    // {
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = TRUE;

    //     if ($this->input->post('username') == '') {
    //         $data['inputerror'][] = 'username';
    //         $data['error_string'][] = 'Username is required';
    //         $data['status'] = FALSE;
    //     }

    //     if ($this->input->post('password') == '') {
    //         $data['inputerror'][] = 'password';
    //         $data['error_string'][] = 'Password is required';
    //         $data['status'] = FALSE;
    //     }

    //     if ($data['status'] === FALSE) {
    //         echo json_encode($data);
    //         exit();
    //     }
    // }
}
