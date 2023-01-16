<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('users_role/create'),'&nbsp Add', 'class="btn btn-primary glyphicon-plus"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>ID Hak Akses</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr><?php
            foreach ($users_role_data as $users_role)
            {
            ?>
            <tr>
            <td><?php echo $users_role->id_role ?></td>
            <td><?php echo $users_role->name_role ?></td>
            <td style="text-align:center" width="200px">
            <?php
            echo anchor(site_url('users_role/update/'.$users_role->id_role),'<i class="glyphicon glyphicon-edit" title="Edit"></i>','class="btn btn-xs btn-warning"'); 
            echo '&nbsp | &nbsp'; 
            echo anchor(site_url('users_role/delete/'.$users_role->id_role),'<i class="glyphicon glyphicon-trash" title="Delete"></i>','class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
            ?>
            </td>
        </tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
            <div class="btn btn-primary">
            Total Record : <?php echo $total_rows ?>
            </div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>