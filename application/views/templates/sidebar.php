 <?php
    date_default_timezone_set("Asia/jakarta");
    ?>
 <?php
    $id = $this->session->userdata['id_user'];
    $d = $this->db->query("SELECT * FROM tbl_user WHERE id_user = '$id'")->row();
    ?>
 <div class="sidebar sidebar-style-2">
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <div class="user">
                 <div class="avatar-sm float-left mr-2">
                     <img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $d->image; ?>" alt="..." class="avatar-img rounded-circle">
                 </div>
                 <div class="info">
                     <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                         <span>
                             <?php echo $this->session->userdata['username']; ?>
                             <b>
                                 <div class="fas fa-clock"></div> <span id="jam" style="font-size:20px; color: black;"></span>
                             </b>
                         </span>
                     </a>
                 </div>
             </div>
             <ul class="nav nav-primary">
                 <?php if ($_SESSION["id_level"] == ("1")) { ?>
                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Dashboard</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#master">
                             <i class="fas fa-users"></i>
                             <p>Master Data</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="master">
                             <ul class="nav nav-collapse">

                                 <li>
                                     <a href="<?= base_url('admin/anggota') ?>">
                                         <span class="sub-item">Anggota</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/ketua') ?>">
                                         <span class="sub-item">Ketua</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/user_data') ?>">
                                         <span class="sub-item">Admin</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#simpanan">
                             <i class="fas fa-save"></i>
                             <p>Keuangan</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="simpanan">
                             <ul class="nav nav-collapse">

                                 <li>
                                     <a href="<?= base_url('admin/simpanan') ?>">
                                         <span class="sub-item">Simpanan</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/pinjaman') ?>">
                                         <span class="sub-item">Pinjaman</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/list_angsuran') ?>">
                                         <span class="sub-item">Angsuran</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#laporan">
                             <i class="fas fa-print"></i>
                             <p>Laporan</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="laporan">
                             <ul class="nav nav-collapse">
                                 <li>
                                     <a href="<?= base_url('admin/laporan_simpanan') ?>">
                                         <span class="sub-item">Simpanan</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/laporan_angsuran') ?>">
                                         <span class="sub-item">Angsuran</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="modal" href="#logout" class="collapsed" aria-expanded="false">
                             <i class="fas fa-sign-out-alt"></i>
                             <p>Logout</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION["id_level"] == ("3")) { ?>
                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Dashboard</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('admin/pinjaman_anggota') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-money"></i>
                             <p>Pinjaman</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('admin/angsuran_anggota') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-money-check-alt"></i>
                             <p>Angsuran</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('admin/simpanan_anggota') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-plus-circle"></i>
                             <p>Simpanan</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="modal" href="#logout" class="collapsed" aria-expanded="false">
                             <i class="fas fa-sign-out-alt"></i>
                             <p>Logout</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                 <?php } ?>
                 <?php if ($_SESSION["id_level"] == ("2")) { ?>
                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="collapsed" aria-expanded="false">
                             <i class="fas fa-home"></i>
                             <p>Dashboard</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#master">
                             <i class="fas fa-users"></i>
                             <p>Master Data</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="master">
                             <ul class="nav nav-collapse">
                                 <li>
                                     <a href="<?= base_url('admin/anggota') ?>">
                                         <span class="sub-item">Anggota</span>
                                     </a>
                                 </li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#simpanan">
                             <i class="fas fa-save"></i>
                             <p>Keuangan</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="simpanan">
                             <ul class="nav nav-collapse">

                                 <li>
                                     <a href="<?= base_url('admin/simpanan') ?>">
                                         <span class="sub-item">Simpanan</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/pinjaman') ?>">
                                         <span class="sub-item">Pinjaman</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/list_angsuran') ?>">
                                         <span class="sub-item">Angsuran</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="collapse" href="#laporan">
                             <i class="fas fa-print"></i>
                             <p>Laporan</p>
                             <span class="caret"></span>
                         </a>
                         <div class="collapse" id="laporan">
                             <ul class="nav nav-collapse">
                                 <li>
                                     <a href="<?= base_url('admin/laporan_simpanan') ?>">
                                         <span class="sub-item">Simpanan</span>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="<?= base_url('admin/laporan_angsuran') ?>">
                                         <span class="sub-item">Angsuran</span>
                                     </a>
                                 </li>

                             </ul>
                         </div>
                     </li>
                     <li class="nav-item">
                         <a data-toggle="modal" href="#logout" class="collapsed" aria-expanded="false">
                             <i class="fas fa-sign-out-alt"></i>
                             <p>Logout</p>
                             <!-- <span class="caret"></span> -->
                         </a>
                     </li>
                 <?php } ?>
             </ul>
         </div>
     </div>
 </div>

 <!-- Modal Logout -->
 <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title" id="exampleModalLabel"><b>Logout</b></h4>
             </div>
             <div class="modal-body">
                 Yakin ingin logout ?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                 <a class="btn btn-danger" href="<?= base_url('login/logout'); ?>">Ya</a>
             </div>
         </div>
     </div>
 </div>
 <script type="text/javascript">
     window.onload = function() {
         jam();
     }

     function jam() {
         var e = document.getElementById('jam'),
             d = new Date(),
             h, m, s;
         h = d.getHours();
         m = set(d.getMinutes());
         s = set(d.getSeconds());

         e.innerHTML = h + ':' + m + ':' + s;

         setTimeout('jam()', 1000);
     }

     function set(e) {
         e = e < 10 ? '0' + e : e;
         return e;
     }
 </script>