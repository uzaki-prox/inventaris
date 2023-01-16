<table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>Nama Ruangan</th>
            <th>Lokasi</th>
            <th>PIC</th>
        </tr>
        <?php
            foreach ($room_complet_data as $room_complet)
            {
            ?>
            <tr>
                <td><?php echo $room_complet->name_room ?></td>
                <td><?php echo $room_complet->location ?></td>
                <td><?php echo $this->Room_model->get_user($room_complet->pic)->name ?></td></td>
                <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('room_complet/list_poin/'.$room_complet->id_room),'<i class="glyphicon glyphicon-eye-open" title="Details"></i>','class="btn btn-xs btn-primary"');
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