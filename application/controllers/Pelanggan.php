<?php
class Pelanggan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2' || $this->session->userdata('akses') == '4') {
            $this->load->model('m_pelanggan');
            date_default_timezone_set("Asia/Jakarta");
        } else {
            redirect('login');
        };
    }

    function index()
    {
        $data = [
            'title' => 'List Pelanggan'
        ];
        if ($this->session->userdata('akses') === '1') {
            $this->load->view('pelanggan/v_pelanggan', $data);
        } else if ($this->session->userdata('akses') === '2') {
            $this->load->view('pelanggan/v_kasir', $data);
        } else if ($this->session->userdata('akses') === '4') {
            $this->load->view('pelanggan/v_sales', $data);
        }
    }

    function tambah_pelanggan()
    {
        $kopel = $this->m_pelanggan->get_kopel();
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $notelp = $this->input->post('notelp');
        $this->m_pelanggan->simpan_pelanggan($kopel, $nama, $alamat, $notelp);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Tambah ", "success");');
        redirect('pelanggan');
    }

    function show_pelanggan($id = '')
    {
        $result = $this->m_pelanggan->show_pelanggan($id)->row_array();
        if ($result) {
            $data = array(
                'title' => 'Edit pelanggan',
                'data'    => $result
            );
            $this->load->view('pelanggan/v_editpelanggan', $data);
        } else {
            $this->session->set_flashdata('message', 'swal("error", "Data Tidak Ada", "error");');
            redirect('pelanggan');
        }
    }

    function edit_pelanggan()
    {
        $data = array(
            'pelanggan_nama' =>  $this->input->post('nama'),
            'pelanggan_alamat' => $this->input->post('alamat'),
            'pelanggan_notlpn' => $this->input->post('notelp'),
        );
        // print_r($data);
        // die();
        $this->db->where('pelanggan_id', $this->input->post('id'));
        $this->db->update('tbl_pelanggan', $data);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil ", "success");');
        redirect('pelanggan');
    }
    function hapus_pelanggan($kode = '')
    {
        $this->m_pelanggan->hapus_pelanggan($kode);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Hapus ", "info");');
        redirect('pelanggan');
    }

    public function listpelanggan()
    {
        $hello = "'Are you sure you want to delete this item?'";
        $list = $this->m_pelanggan->tampil_pelanggan()->result_array();
        foreach ($list as $row) {
            $result[] = array(
                'pelanggan_id' => $row['pelanggan_id'],
                'pelanggan_nama'    => $row['pelanggan_nama'],
                'pelanggan_alamat'    => $row['pelanggan_alamat'],
                'pelanggan_notlpn'    =>    $row['pelanggan_notlpn'],
                'action'    =>    '<td style="text-align:center;">
                            <a class="btn btn-xs btn-warning" href="' . base_url('pelanggan/show_pelanggan/' . $row['pelanggan_id']) . '"><span class="fa fa-edit"></span> Edit</a>
                           
                            <a class="btn btn-xs btn-info href=""></span> Barcode</a>
                        	</td>'
            );
        }
        //  <a class="btn btn-xs btn-danger" href="'.base_url('pelanggan/hapus_pelanggan/'.$row['pelanggan_id']).'" onclick="return confirm('.$hello.');"><span class="fa fa-close"></span> Hapus</a>
        $data = [
            'data' => $result,
        ];
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getpelanggan()
    {
        $id = $this->input->get('q');
        if ($id == NULL) {
            $getpel = $this->m_pelanggan->tampil_pelanggan()->result_array();
            // die(print_r($getpel));
            foreach ($getpel as $row) {
                $result[] = array(
                    'id' => $row['pelanggan_id'],
                    'text' => $row['pelanggan_nama']
                );
            }
            echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
        } else {
            $getpel = $this->db->query('select pelanggan_id,pelanggan_nama from tbl_suplier where pelanggan_nama like "%' . $id . '%" ')->result_array();
            if ($getarf) {
                foreach ($getpel as $row) {
                    $result[] = array(
                        'id' => $row['pelanggan_id'],
                        'text' => $row['pelanggan_nama']
                    );
                }
                echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
            } else {
                $result[] = array(
                    'id' => 'kosong',
                    'text' => 'data tidak ada'
                );
                echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
            }
        }
    }
}
