<?php
class M_retur extends CI_Model
{
    function get_nofak()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(retur_kode,6)) AS kd_max FROM tbl_retur ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        return 'RT' . date('dmy') . $kd;
    }

    function cetak_faktur($nofak)
    {
        $hsl = $this->db->query("SELECT * FROM tbl_retur JOIN tbl_detail_retur ON retur_kode = d_retur_id JOIN tbl_pelanggan ON retur_pelanggan = pelanggan_id  JOIN tbl_suplier ON retur_suplier_id = suplier_id JOIN tbl_user ON retur_user_id = user_id WHERE retur_kode = '$nofak'");
        return $hsl;
    }
}
