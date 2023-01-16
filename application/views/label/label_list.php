<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('label/create'),'&nbsp Add', 'class="btn btn-primary glyphicon-plus"'); ?>
                <?php echo anchor(site_url('label/label_excel'),'&nbsp Export to Excel', 'class="btn btn-danger"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('label/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('label'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>Kode Barang</th>
            <th>No Urut</th>
            <th>Tahun Pengadaan</th>
            <th>Sumber Dana</th>
            <th>Ruangan</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($label_data as $label)
            {
                ?>
                <tr>
            <td><?php echo $label->unit ?> . <?php echo $label->cluster ?> . <?php echo $label->type ?> . <?php echo $label->object ?></td>
            <td><?php echo $label->serial_number ?></td>
            <td><?php echo $label->year ?></td>
            <td><?php echo $label->source ?></td>
            <td><?php echo $this->Label_model->get_room($label->room)->name_room ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('label/update/'.$label->no_label),'<i class="glyphicon glyphicon-edit" title="Edit"></i>','class="btn btn-xs btn-warning"');
                echo '&nbsp | &nbsp'; 
                echo anchor(site_url('label/label_word/'.$label->no_label),'<i class="glyphicon glyphicon-file" title="Print"></i>','class="btn btn-xs btn-info"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                echo '&nbsp | &nbsp'; 
                echo anchor(site_url('label/delete/'.$label->no_label),'<i class="glyphicon glyphicon-trash" title="Delete"></i>','class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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