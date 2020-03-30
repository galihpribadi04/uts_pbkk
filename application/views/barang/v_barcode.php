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
            <!--End Info-->
            <!-- or -->
            <img id="barcode" />
            <!-- or -->
            <script>
                $("#barcode").JsBarcode("<?php echo $code ?>");
            </script>
        </center>
        <!--End InvoiceTop-->
    </div>

</body>

</html>