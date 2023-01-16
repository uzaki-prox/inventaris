<table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>Nama Ruangan</th>
            <th>Lokasi</th>
            <th>PIC</th>
            <th style="text-align:center">Action</th>
        </tr>
        <?php
            foreach ($room_infra_data as $room_infra)
            {
            ?>
            <tr>
                <td><?php echo $room_infra->name_room ?></td>
                <td><?php echo $room_infra->location ?></td>
                <td><?php echo $this->Room_model->get_user($room_infra->pic)->name ?></td></td>
                <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('qc_infrastructure/form_qc/'.$room_infra->id_room),'<i class="glyphicon glyphicon-eye-open" title="Details"></i>','class="btn btn-xs btn-primary"');
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