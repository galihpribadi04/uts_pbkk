<?php
class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '3') {
            $this->load->model('m_kategori');
            date_default_timezone_set("Asia/Jakarta");
        } else {
            redirect('login');
        };
    }

    function index()
    {
        $data = [
            'title' => 'List Kategori'
        ];
        $this->load->view('kategori/v_kategori', $data);
    }

    function tambah_kategori()
    {
        $kat = $this->input->post('kategori');
        $this->m_kategori->simpan_kategori($kat);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Tambah data ", "success");');
        redirect('admin/kategori');
    }

    function show_kategori($id = '')
    {
        $result = $this->m_kategori->show_kategori($id)->row_array();
        if ($result) {
            $data = array(
                'title' => 'Edit kategori',
                'data'    => $result
            );
            // die(print_r($data));
            $this->load->view('kategori/v_editkategori', $data);
        } else {
            $this->session->set_flashdata('message', 'swal("error", "Data Tidak Ada", "error");');
            redirect('kategori');
        }
    }

    function edit_kategori()
    {
        $data = array(
            'kategori_nama' =>  $this->input->post('kategori'),
        );
        $this->db->where('kategori_id', $this->input->post('id'));
        $this->db->update('tbl_kategori', $data);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil ", "success");');
        redirect('kategori');
    }

    function hapus_kategori($kode = "")
    {
        $this->m_kategori->hapus_kategori($kode);
        $this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil di hapus", "info");');
        redirect('kategori');
    }

    public function listkategori()
    {
        $hello = "'Are you sure you want to delete this item?'";
        $list = $this->m_kategori->tampil_kategori()->result_array();
        foreach ($list as $row) {
            $result[] = array(
                'kategori_id' => $row['kategori_id'],

                'kategori_nama'    =>    $row['kategori_nama'],
                'action'    =>    '<td style="text-align:center;"><a class="btn btn-xs btn-warning" href="' . base_url('kategori/show_kategori/' . $row['kategori_id']) . '"> <span class="fa fa-edit"></span> Edit</a> <a class="btn btn-xs btn-danger" href="' . base_url('kategori/hapus_kategori/' . $row['kategori_id']) . '" onclick="return confirm(' . $hello . ');"> <span class="fa fa-close"> </span> Hapus</a> <a class="btn btn-xs btn-info href=""></span> Barcode</a></td>'
            );
        }
        $data = [
            'data' => $result,
        ];
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function getkategori()
    {
        $id = $this->input->get('q');
        if ($id == NULL) {
            $getsup = $this->m_kategori->tampil_kategori()->result_array();
            // die(print_r($getsup));
            foreach ($getsup as $row) {
                $result[] = array(
                    'id' => $row['kategori_id'],
                    'text' => $row['kategori_nama']
                );
            }
            echo json_encode($data = array('result' => $result), JSON_PRETTY_PRINT);
        } else {
            $getsup = $this->db->query('select kategori_id,kategori_nama from tbl_kategori where kategori_nama like "' . $id . '" ');
            foreach ($getsup as $row) {
                $result[] = array(
                    'id' => $row['kategori_id'],
                    'text' => $row['kategori_nama']
                );
            }
            if ($getarf) {
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
