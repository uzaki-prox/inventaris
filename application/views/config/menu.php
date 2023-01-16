<div class="col-xs-6 col-sm-3 sidebar-offcanvas" style="padding-bottom: 40px" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item" style="background-color : #E6E9ED;"><i class="glyphicon glyphicon-align-justify"></i> <b>MENU UTAMA</b></li>
                <!--<li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>-->
                <li class="list-group-item"><a href="<?php echo base_url()?>"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
                
                <?php 
                if ($this->session->userdata('id_role') == '1') {
                 ?>
                <!--<li>
                  <a href="#demo1" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-book"></i>Buku  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo1">
                    <a href="buku_tamu" class="list-group-item ">Buku Tamu </a>
                    <a href="tamu_psb" class="list-group-item ">Buku PSB </a>
                  </li>
                </li>-->
                <li>
                  <a href="#demo1" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-home"></i>Ruangan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo1">
                    <a href="room" class="list-group-item">Ruangan</a>
                    <a href="room_kind" class="list-group-item">Jenis Ruangan</a>
                  </li>
                </li>

                <li>
                  <a href="#demo2" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-leaf"></i>Kebersihan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo2">
                    <a href="clean_inst" class="list-group-item">Poin Kebersihan</a>
                    <a href="room_clean" class="list-group-item">Poin Kebersihan Per Ruangan</a>
                    <a href="qc_clean" class="list-group-item">Quality Control Kebersihan</a>
                  </li>
                </li>

                <li>
                  <a href="#demo3" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-briefcase"></i>Kelengkapan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo3">
                    <a href="complete_inst" class="list-group-item">Poin Kelengkapan</a>
                    <a href="room_complet" class="list-group-item">Poin Kelengkapan Per Ruangan</a>
                    <a href="qc_complet" class="list-group-item">Quality Control Kelengkapan</a>
                  </li>
                </li>

                <li>
                  <a href="#demo4" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-tags"></i>Prasarana<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo4">
                    <a href="unit" class="list-group-item">Unit</a>
                    <a href="cluster" class="list-group-item">Kelompok</a>
                    <a href="type" class="list-group-item">Jenis</a>
                    <a href="object" class="list-group-item">Objek</a>
                    <a href="label" class="list-group-item">Label</a>
                    <a href="qc_infrastructure" class="list-group-item">Quality Control Prasarana</a>
                  </li>
                </li>

                <li>
                  <a href="#demo5" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-usd"></i>Keuangan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo5">
                    <a href="asset" class="list-group-item">Aset</a>
                    <a href="deprec" class="list-group-item">Penyusutan Aset</a>
                  </li>
                </li> 

                <li>
                  <a href="#demo6" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-user"></i>Manajemen User<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo6">
                    <a href="users_role" class="list-group-item">Hak Akses</a>
                    <a href="users" class="list-group-item">User</a>
                  </li>
                </li>

                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php 
                } elseif ($this->session->userdata('id_role') == '2') {
                 ?>
                <li>
                  <a href="#demo7" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-leaf"></i>Kebersihan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo7">
                    <a href="cleaning" class="list-group-item">Poin Kebersihan</a>
                    <a href="qc_clean" class="list-group-item">Quality Control Kebersihan</a>
                  </li>
                </li>

                <li>
                  <a href="#demo8" class="list-group-item" data-toggle="collapse"><i class="glyphicon glyphicon-briefcase"></i>Kelengkapan<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <li class="collapse" id="demo8">
                    <a href="complete_inst" class="list-group-item">Poin Kelengkapan</a>
                    <a href="qc_complet" class="list-group-item">Quality Control Kelengkapan</a>
                  </li>
                </li>

                <li>
                  <a href="qc_infrastructure" class="list-group-item"><i class="glyphicon glyphicon-tags"></i>Quality Control Prasarana</a>
                </li>

                <li>
                  <a href="change_pass" class="list-group-item "><i class="glyphicon glyphicon-user"></i>Manajemen User </a>
                </li>

                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php 
                } elseif ($this->session->userdata('id_role') == '3') {
                 ?>
                <li>
                  <a href="qc_clean" class="list-group-item"><i class="glyphicon glyphicon-leaf"></i>Quality Control Kebersihan</a>
                </li>

                <li>
                  <a href="qc_complet" class="list-group-item"><i class="glyphicon glyphicon-briefcase"></i>Quality Control Kelengkapan</a>
                </li>

                <li>
                  <a href="qc_infrastructure" class="list-group-item"><i class="glyphicon glyphicon-tags"></i>Quality Control Prasarana</a>
                </li>
                
                <li>
                  <a href="change_pass" class="list-group-item "><i class="glyphicon glyphicon-user"></i>Manajemen User </a>
                </li>

                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php 
                } elseif ($this->session->userdata('id_role') == '4') {
                 ?>
                <li>
                  <a href="unit" class="list-group-item"><i class="glyphicon glyphicon-th-large"></i>Unit </a>
                </li>
                
                <li>
                  <a href="cluster" class="list-group-item"><i class="glyphicon glyphicon-th"></i>Kelompok </a>
                </li>

                <li>
                  <a href="type" class="list-group-item"><i class="glyphicon glyphicon-th-list"></i>Jenis </a>
                </li>

                <li>
                  <a href="object" class="list-group-item"><i class="glyphicon glyphicon-list-alt"></i>Objek </a>
                </li>

                <li>
                  <a href="asset" class="list-group-item"><i class="glyphicon glyphicon-usd"></i>Aset</a>
                </li>

                <li>
                  <a href="label" class="list-group-item"><i class="glyphicon glyphicon-tags"></i>Label </a>
                </li>

                <li>
                  <a href="change_pass" class="list-group-item "><i class="glyphicon glyphicon-user"></i>Manajemen User </a>
                </li>

                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php 
                } elseif ($this->session->userdata('id_role') == '5') {
                 ?>
                <li>
                  <a href="object" class="list-group-item"><i class="glyphicon glyphicon-list-alt"></i>Objek </a>
                </li>

                <li>
                  <a href="label" class="list-group-item"><i class="glyphicon glyphicon-tags"></i>Label </a>
                </li>
                
                <li>
                  <a href="change_pass" class="list-group-item "><i class="glyphicon glyphicon-user"></i>Manajemen User </a>
                </li>
                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php
                } elseif ($this->session->userdata('id_role') == '6') {
                ?>
                <li>
                  <a href="deprec" class="list-group-item"><i class="glyphicon glyphicon-list-alt"></i>Penyusutan </a>
                </li>
                
                <li>
                  <a href="change_pass" class="list-group-item "><i class="glyphicon glyphicon-user"></i>Manajemen User </a>
                </li>
                <li class="list-group-item"><a href="<?php echo base_url()?>app/logout"><i class="glyphicon glyphicon-share"></i>Sign Out </a></li>

                <?php } ?>

              </ul>
          </div>