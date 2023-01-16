        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('deprec/create'),'&nbsp Add', 'class="btn btn-primary glyphicon-plus"'); ?>
                <?php echo anchor(site_url('deprec/deprec_excel'),'&nbsp Export to Excel', 'class="btn btn-danger"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('deprec/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('deprec'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Filter</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>Kode Barang</th>
            <th>Tahun Pengadaan</th>
            <th>Umur Ekonomi</th>
            <th>Harga Perolehan</th>
            <th>Penyusutan Per Tahun</th>
            <th>Sisa Umur</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($deprec_data as $deprec)
            {
                ?>
                <tr>
            <td><?php echo $this->Deprec_model->get_label($deprec->no_label)->unit ?>
                .<?php echo $this->Deprec_model->get_label($deprec->no_label)->cluster ?>
                .<?php echo $this->Deprec_model->get_label($deprec->no_label)->type ?>
                .<?php echo $this->Deprec_model->get_label($deprec->no_label)->object ?></td>
            <td><?php echo $deprec->year_procurement ?></td>
            <td><?php echo $deprec->economics_age ?></td>
            <td><?php echo $deprec->acquisition_cost ?></td>
            <td><?php echo $deprec->dep_per_year ?></td>
            <td><?php echo $deprec->remaining_age ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('deprec/update/'.$deprec->no_deprec),'<i class="glyphicon glyphicon-edit" title="Edit"></i>','class="btn btn-xs btn-warning"');
                echo '&nbsp | &nbsp'; 
                echo anchor(site_url('deprec/delete/'.$deprec->no_deprec),'<i class="glyphicon glyphicon-trash" title="Delete"></i>','class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>