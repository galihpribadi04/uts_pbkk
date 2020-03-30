<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
    <script src="<?php echo base_url('assets/js/JsBarcode.code128.min.js') ?>"></script>
    <style>
        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 58mm;
            background: #FFF;
        }
    </style>
</head>

<body onload="window.print()">
    <div id="invoice-POS">

        <center>
            <?php foreach ($barcode as $row) { ?>
                <!-- or -->
                <img id="barcode<?php echo $row['barang_id'] ?>" />
                <p> <?php echo $row['barang_nama'] ?>
                    <p />

                    <!-- or -->
                    <script>
                        $("#barcode<?php echo $row['barang_id'] ?>").JsBarcode("<?php echo $row['barang_id'] ?>");
                    </script>
                <?php } ?>

        </center>
        <!--End InvoiceTop-->
    </div>

</body>

</html>