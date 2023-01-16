<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('room_kind/create'),'&nbsp Add', 'class="btn btn-primary glyphicon-plus"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('room_kind/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('room_kind'); ?>" class="btn btn-default">Reset</a>
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
            <th>ID Jenis</th>
            <th>Jenis</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($room_kind_data as $room_kind)
            {
                ?>
                <tr>
            <td><?php echo $room_kind->id_kind ?></td>
            <td><?php echo $room_kind->name_kind ?></td>
            <td style="text-align:center" width="200px">
                <?php 
                echo anchor(site_url('room_kind/update/'.$room_kind->id_kind),'<i class="glyphicon glyphicon-edit" title="Edit"></i>','class="btn btn-xs btn-warning"'); 
                echo '&nbsp | &nbsp'; 
                echo anchor(site_url('room_kind/delete/'.$room_kind->id_kind),'<i class="glyphicon glyphicon-trash" title="Delete"></i>','class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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