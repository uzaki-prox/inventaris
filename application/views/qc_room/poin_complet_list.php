<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" class="form-control" name="qc_rcomplet" id="qc_rcomplet" value="<?php echo $qc_rcomplet ?>" />
            <input type="hidden" class="form-control" name="room" id="room" value="<?php echo $room ?>" />
            <label for="varchar">Uraian Kelengkapan <?php echo form_error('instrument') ?></label>
            <select name="instrument" class="form-control">
                <?php
                $sql = $this->db->get('complet_instrument');
                foreach ($sql->result() as $mi) { ?>
                <option value="<?php echo $mi->id_complet ?>" <?php echo ($instrument == $mi->id_complet) ? 'selected' : '' ?>><?php echo $mi->instrument_complet ?></option>
                <?php } ?>
            </select>
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        </div>
</form>

        <?php $pic = $this->Room_complet_model->get_room($room)->pic ?>
        <?php $name = $this->Room_model->get_user($pic)->name ?>
        <div class="row" style="margin-bottom: 2px">
            <div class="col-md-4">
                <table>
                    <tr>
                        <th>Ruangan</th>
                        <th>&emsp; : &nbsp;</th>
                        <th><?php echo $this->Room_complet_model->get_room($room)->name_room ?></th>
                    </tr>
                    <tr>
                        <th>PIC</th>
                        <th>&emsp; : &nbsp;</th>
                        <th><?php echo $name ?></th>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 5px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <?php echo anchor(site_url('room_complet/room_complet_excel'),'&nbsp Export to Excel', 'class="btn btn-danger"'); ?>
            </div>
        </div>
        
        <table class="table table-bordered" style="margin-bottom: 10px">
        <tr>
            <th>Uraian Kelengkapan</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($poin_complet_data as $poin_complet)
            {
                ?>
                <tr>
                <td><?php echo $this->Room_complet_model->get_instrument($poin_complet->instrument)->instrument_complet ?></td>
                <td><?php echo $this->Room_complet_model->get_instrument($poin_complet->instrument)->descript ?></td>
                <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('room_complet/delete/'.$poin_complet->qc_rcomplet),'<i class="glyphicon glyphicon-trash" title="Delete"></i>','class="btn btn-xs btn-danger"','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
            </td>
        </tr>
            <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                Total Record : <?php echo $total_rows ?>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>