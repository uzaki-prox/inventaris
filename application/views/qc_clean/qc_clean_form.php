<table class="table table-bordered" style="margin-bottom: 10px">
        <div class="form-group">
            <label for="varchar">Tanggal <?php echo form_error('date') ?></label>
            <input type="int" class="form-control" name="date" id="date" placeholder="Tanngal" value="<?php echo $date; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="int">Ruangan <?php echo form_error('room') ?></label>
            <input type="int" class="form-control" name="room" id="room" placeholder="Ruangan" value="<?php echo $room; ?>" readonly />
        </div>
            <tr>
                <th>Uraian Kebersihan</th>
                <th style="text-align:center">Status</th>
                <th>Keterangan</th>
                <th>Action</th>
            </tr>
            
            <?php foreach($list_date_data as $list_date){ ?>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            
            <tr>
                <td><?php echo $list_date->instrument; ?></td>
                <td><label for="clean"><input type="radio" name="clean" id="clean" value="Bersih"> Bersih</label> &nbsp;
                <label for="clean"><input type="radio" name="clean" id="clean" value="Sedang"> Sedang</label> &nbsp;
                <label for="clean"><input type="radio" name="clean" id="clean" value="Kotor"> Kotor</label></td>
                <td style="width:70px"><textarea name="descript" id="descript" cols="70" rows="3" placeholder="Keterangan"></textarea></td>
                <td><button type="submit" class="btn btn-primary"><?php echo $button ?></button></td>
            </tr>
           
            </form>
            <?php } ?>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>

        <!-- <a href="<?php echo site_url('qc_clean/delete_temp/' .$list_date_data->date) ?>" class="btn btn-default">Cancel</a> -->
     </table>