<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Objek <?php echo form_error('id_object') ?></label>
            <input type="text" class="form-control" name="id_object" id="id_object" placeholder="ID Objek" value="<?php echo $id_object; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Objek <?php echo form_error('name_object') ?></label>
            <input type="text" class="form-control" name="name_object" id="name_object" placeholder="Nama Objek" value="<?php echo $name_object; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('descript') ?></label>
            <input type="text" class="form-control" name="descript" id="descript" placeholder="Keterangan" value="<?php echo $descript; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jenis Aset <?php echo form_error('asset') ?></label>
            <select name="asset" class="form-control">
                <?php
                $sql = $this->db->get('asset');
                foreach ($sql->result() as $row) { ?>
                <option value="<?php echo $row->id_asset ?>" <?php echo ($asset == $row->id_asset) ? 'selected' : '' ?>><?php echo $row->name_asset ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="id_object2" value="<?php echo $id_object; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('object') ?>" class="btn btn-default">Cancel</a>
    </form>