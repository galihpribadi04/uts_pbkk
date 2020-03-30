 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
     <div class="container">
         <!-- Brand and toggle get grouped for better mobile display -->
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="<?php echo base_url() . 'welcome' ?>">Point Of Sales</a>
         </div>
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav">
                 <?php $h = $this->session->userdata('akses'); ?>
                 <?php $u = $this->session->userdata('user'); ?>
                 <?php if ($h == '1') { ?>
                     <!--dropdown-->
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'penjualan' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Penjualan (Eceran)</a></li>
                             <li><a href="<?php echo base_url() . 'penjualan_grosir' ?>"><span class="fa fa-cubes" aria-hidden="true"></span> Penjualan (Grosir)</a></li>
                             <li><a href="<?php echo base_url() . 'penjualan_sales' ?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Penjualan (Sales)</a></li>
                         </ul>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'penjualan_history' ?>"><span class="fa fa-history"></span> History Transaksi</a>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'pelanggan' ?>"><span class="fa fa-users"></span> Pelanggan</a>
                     </li>
                     <!--ending dropdown-->
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-list-alt" aria-hidden="true"></span> Barang</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'barang' ?>"><span class="fa fa-list-alt" aria-hidden="true"></span> Stock Barang</a></li>
                             <li><a href="<?php echo base_url() . 'pembelian' ?>"><span class="fa fa-list" aria-hidden="true"></span> Pembelian Barang</a></li>
                             <li><a href="<?php echo base_url() . 'pembelian_history' ?>"><span class="fa fa-history" aria-hidden="true"></span> History Pembelian</a></li>
                             <li><a href="<?php echo base_url() . 'suplier' ?>"><span class="fa fa-truck" aria-hidden="true"></span> Suplier</a></li>
                             <li><a href="<?php echo base_url() . 'Kategori' ?>"><span class="fa fa-sitemap" aria-hidden="true"></span> Kategori</a></li>
                         </ul>
                     </li>
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-tags" aria-hidden="true"></span> Retur</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'retur/pelanggan' ?>"><span class="fa fa-sticky-note" aria-hidden="true"></span> Retur Pelanggan</a></li>
                             <li><a href="<?php echo base_url() . 'retur/toko' ?>"><span class="fa fa-recycle" aria-hidden="true"></span> Retur Toko</a></li>
                             <li><a href="<?php echo base_url() . 'retur/sales' ?>"><span class="fa fa-recycle" aria-hidden="true"></span> Retur Sales</a></li>
                             <li><a href="<?php echo base_url() . 'retur' ?>"><span class="fa fa-history" aria-hidden="true"></span> History Retur</a></li>


                         </ul>
                     </li>

                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-file" aria-hidden="true"></span> Laporan</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'laporan' ?>"><span class="fa fa-file" aria-hidden="true"></span> Laporan</a></li>
                             <li><a href="<?php echo base_url() . 'grafik' ?>"><span class="fa fa-bar-chart" aria-hidden="true"></span> grafik</a></li>

                         </ul>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'pengguna' ?>"><span class="fa fa-user"></span> Pengguna</a>
                     </li>
                 <?php } ?>
                 <?php if ($h == '2') { ?>
                     <!--dropdown-->
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Transaksi</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'penjualan' ?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span> Penjualan (Eceran)</a></li>
                             <li><a href="<?php echo base_url() . 'penjualan_grosir' ?>"><span class="fa fa-cubes" aria-hidden="true"></span> Penjualan (Grosir)</a></li>
                             <li><a href="<?php echo base_url() . 'penjualan_sales' ?>"><span class="fa fa-shopping-bag" aria-hidden="true"></span> Penjualan (Sales)</a></li>
                         </ul>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'penjualan_history' ?>"><span class="fa fa-history"></span> History Transaksi</a>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'pelanggan' ?>"><span class="fa fa-users"></span> Pelanggan</a>
                     </li>
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-tags" aria-hidden="true"></span> Retur</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'retur/pelanggan' ?>"><span class="fa fa-sticky-note" aria-hidden="true"></span> Retur Pelanggan</a></li>
                             <li><a href="<?php echo base_url() . 'retur/toko' ?>"><span class="fa fa-recycle" aria-hidden="true"></span> Retur Toko</a></li>
                             <li><a href="<?php echo base_url() . 'retur/sales' ?>"><span class="fa fa-recycle" aria-hidden="true"></span> Retur Sales</a></li>
                             <li><a href="<?php echo base_url() . 'retur' ?>"><span class="fa fa-history" aria-hidden="true"></span> History Retur</a></li>
                         </ul>
                     </li>
                     <!--ending dropdown-->
                 <?php } ?>
                 <?php if ($h == '3') { ?> >
                     <!--ending dropdown-->
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-list-alt" aria-hidden="true"></span> Barang</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'barang' ?>"><span class="fa fa-list-alt" aria-hidden="true"></span> Stock Barang</a></li>
                             <li><a href="<?php echo base_url() . 'pembelian' ?>"><span class="fa fa-list" aria-hidden="true"></span> Pembelian Barang</a></li>
                             <li><a href="<?php echo base_url() . 'pembelian_history' ?>"><span class="fa fa-history" aria-hidden="true"></span> History Pembelian</a></li>
                             <li><a href="<?php echo base_url() . 'suplier' ?>"><span class="fa fa-truck" aria-hidden="true"></span> Suplier</a></li>
                             <li><a href="<?php echo base_url() . 'Kategori' ?>"><span class="fa fa-sitemap" aria-hidden="true"></span> Kategori</a></li>
                         </ul>
                     </li>
                     <li class="dropdown">
                         <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Transaksi"><span class="fa fa-tags" aria-hidden="true"></span> Retur</a>
                         <ul class="dropdown-menu">
                             <li><a href="<?php echo base_url() . 'retur/pelanggan' ?>"><span class="fa fa-sticky-note" aria-hidden="true"></span> Retur Pelanggan</a></li>
                             <li><a href="<?php echo base_url() . 'retur/toko' ?>"><span class="fa fa-recycle" aria-hidden="true"></span> Retur Toko</a></li>
                             <li><a href="<?php echo base_url() . 'penjualan/history' ?>"><span class="fa fa-history" aria-hidden="true"></span> History Retur</a></li>


                         </ul>
                     </li>
                     <!--ending dropdown-->
                 <?php } ?>
                 <?php if ($h == '4') { ?> >
                     <li>
                         <a href="<?php echo base_url() . 'sales' ?>"><span class="fa fa-shopping-cart"></span> Barang</a>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'pelanggan' ?>"><span class="fa fa-users"></span> Pelanggan</a>
                     </li>
                     <li>
                         <a href="<?php echo base_url() . 'sales/history' ?>"><span class="fa fa-history"></span> History Transaksi</a>
                     </li>
                     <!--ending dropdown-->
                 <?php } ?>
                 <li>
                     <a href="<?php echo base_url() . 'login/logout' ?>"><span class="fa fa-sign-out"></span> Logout</a>
                 </li>
             </ul>


         </div>
         <!-- /.navbar-collapse -->
     </div>
     <!-- /.container -->
 </nav>