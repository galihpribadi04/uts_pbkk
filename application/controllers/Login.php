<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
    function index()
    {
        $data = array(
            'title' =>  "Login | Point Of Sales"
        );
        $this->load->view('v_login', $data);
    }

    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        echo json_encode($ip, JSON_PRETTY_PRINT);
    }

    function cekuser()
    {
        $username = strtolower($this->input->post('username'));
        $ambil = $this->db->query('select * from tbl_user where user_username = "' . $username . '"')->row_array();
        if ($ambil) {
            $password = $this->input->post('password');
            if (password_verify($password, $ambil['user_password'])) {
                $sess = array(
                    'masuk' => true,
                    'idadmin' => $ambil['user_id'],
                    'nama' => $ambil['user_nama'],
                    'akses' => $ambil['user_level'],
                );
                // die(print_r($sess));
                $this->session->set_userdata($sess);
                $data = [
                    'status' => 'success'
                ];
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                $data = [
                    'status' => 'password'
                ];
                echo json_encode($data, JSON_PRETTY_PRINT);
            }
        } else {
            $data = [
                'status' => 'username'
            ];
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        session_destroy();
        redirect('login');
    }
}
