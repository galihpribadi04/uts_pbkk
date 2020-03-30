<html>
<title>Faktur Retur Barang</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
<div id="laporan">
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
    <style>
        @page {
            size: A5
        }
    </style>
    </head>

    <body onload="window.print()" style='font-family:tahoma; font-size:8pt;' class="A5">
        <center>
            <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                <?php
                $b = $data->row_array();
                // die(print_r($b));
                ?>
                <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                    <span style='font-size:12pt'><b>Toko PUNGU JAYA</b></span>
                    </br>
                    Jl. Kebon Bawang V No. 5B Pasar Ular Permai
                    </br>
                    No Telp : (021) 4369802 / (021) 4350782
                </td>
                <td style='vertical-align:top' width='30%' align='left'>
                    <b><span style='font-size:12pt'>FAKTUR Retur</span></b>
                    </br>
                    No Retur : <?php echo $b['retur_kode'] ; ?></br>
                    Tanggal : <?php echo tgl_ind($b['retur_tanggal']); ?></br>
                    No. Pelanggan : <?php echo ($b['retur_pelanggan']); ?></br>
                </td>
            </table>
            <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
                <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
            </table>
            <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

                <tr align='center'>
                    <td width='2%'>NO</td>
                    <th width='2%'>Kode Barang</th>
                    <td width='20%'>Nama Barang</td>
                    <td width='2%'>Qty</td>
                    <td width='13%'>Keterangan</td>
                    <?php
                    $no = 0;
                    foreach ($data->result_array() as $i) {
                        $no++;
                        $code = $i['d_retur_barang_id'];
                        $name = $i['d_retur_barang'];
                        $qty = $i['d_retur_qty'];
                        $desc = $i['d_retur_desc'];
                       
                        ?>
                <tr>
                <tr>
                    <td  align='center'><?php echo $no; ?></td>
                    <td><?php echo $code; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $desc; ?></td>
               </tr>
            <?php } ?>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Pelanggan :</div>
                </td>
                <td style='text-align:right'><?php echo $b['pelanggan_nama'] ?></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Suplier :</div>
                </td>
                <td style='text-align:right'><?php  echo $b['suplier_nama'] ?></td>
            </tr>
            
            </table>
            <br>
            <table style='width:600; font-size:7pt;' cellspacing='2'>
                <tr>
                    <td align='center'>Kasir</br></br><br><br><u> ( <?php  echo $b['user_nama']; ?> )</u>
                    </td>
                    <!-- <td style='border:1px solid black; padding:8px; text-align:left; width:50%'>
                        <p>Terbilang : <i> <b><?php echo ucwords(number_to_words($b['retur_total'])); ?></b></i></p>
                        <p>BCA : A/C. 007.300.4591 <br>Mandiri : A/C. 1200009895546 <br>Atas Nama : Bariin Manik </p>
                    </td> -->
                    <td align='center'>Pelanggan</br></br><br><br><u> ( <?php echo $b['pelanggan_nama']; ?> )</u></td>
            </table>
            <td align="left">
                <!-- <p><b>PERHATIAN!!!</b> BARANG-BARANG YANG SUDAH DIBELI TIDAK DAPAT DI TUKAR DI KEMBALIKAN</p> -->
            </td>
        </center>
</div>
</body>

</html>