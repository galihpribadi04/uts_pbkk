<?php
class Suplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '3') {
            $this->load->model('m_suplier');
            date_default_timezone_set("Asia/Jakarta");
        } else {
            redirect('login');
        };
    }

    function index()
    {
        $data = [
            'title' => 'List Suplier'
        ];
        $this->load->view('suplier/v_suplier', $data);
    }

    function tambah_suplier()
    {
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $notelp = $this->input->post('notelp');
        $this->m_suplier->simpan_suplier($nama, $alamat, $notelp);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Tambah data ", "success");');
        redirect('suplier');
    }
    function show_suplier($id = '')
    {
        $result = $this->m_suplier->show_suplier($id)->row_array();
        if ($result) {
            $data = array(
                'title' => 'Edit suplier',
                'data'    => $result
            );
            // die(print_r($data));
            $this->load->view('suplier/v_editsuplier', $data);
        } else {
            $this->session->set_flashdata('message', 'swal("error", "Data Tidak Ada", "error");');
            redirect('suplier');
        }
    }

    function edit_suplier()
    {

        $data = array(
            'suplier_nama' =>  $this->input->post('nama'),
            'suplier_alamat' => $this->input->post('alamat'),
            'suplier_notelp' => $this->input->post('notelp'),
        );
        $this->db->where('suplier_id', $this->input->post('id'));
        $this->db->update('tbl_suplier', $data);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil ", "success");');
        redirect('suplier');
    }

    function hapus_suplier($kode = "")
    {
        $this->m_suplier->hapus_suplier($kode);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Data berhasil di hapus ", "info");');
        redirect('suplier');
    }

    public function listsuplier()
    {
        $hello = "'Are you sure you want to delete this item?'";
        $list = $this->m_suplier->tampil_suplier()->result_array();
        $i = 1;
        foreach ($list as $row) {
            $result[] = array(
                'suplier_id' => $i++,
                'suplier_nama'    => $row['suplier_nama'],
                'suplier_alamat'    => $row['suplier_alamat'],
                'suplier_notlpn'    =>    $row['suplier_notelp'],
                'action'    =>    '<td style="text-align:center;"><a class="btn btn-xs btn-warning" href="' . base_url('suplier/show_suplier/' . $row['suplier_id']) . '"> <span class="fa fa-edit"></span> Edit</a> <a class="btn btn-xs btn-info href=""></span> Barcode</a></td>'
            );
        }
        // <a class="btn btn-xs btn-danger" href="'.base_url('suplier/hapus_suplier/'.$row['suplier_id']).'" onclick="return confirm('.$hello.');"> <span class="fa fa-close"> </span> Hapus</a> 
        $data = [
            'data' => $result,
        ];
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getsuplier()
    {
        $id = $this->input->get('q');
        if ($id == NULL) {
            $getsup = $this->m_suplier->tampil_suplier()->result_array();
            // die(print_r($getsup));
            foreach ($getsup as $row) {
                $result[] = array(
                    'id' => $row['suplier_id'],
                    'text' => $row['suplier_nama']
                );
            }
            echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
        } else {
            $getsup = $this->db->query('select suplier_id,suplier_nama from tbl_suplier where suplier_nama like "%' . $id . '%" ')->result_array();
            // die(print_r($getsup));
            if ($getsup) {
                foreach ($getsup as $row) {
                    $result[] = array(
                        'id' => $row['suplier_id'],
                        'text' => $row['suplier_nama']
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
