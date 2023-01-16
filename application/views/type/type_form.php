<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Jenis <?php echo form_error('id_type') ?></label>
            <input type="text" class="form-control" name="id_type" id="id_type" placeholder="ID Jenis" value="<?php echo $id_type; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Jenis <?php echo form_error('name_type') ?></label>
            <input type="text" class="form-control" name="name_type" id="name_type" placeholder="Jenis" value="<?php echo $name_type; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Keterangan <?php echo form_error('descript') ?></label>
            <input type="text" class="form-control" name="descript" id="descript" placeholder="Keterangan" value="<?php echo $descript; ?>" />
        </div>
        <input type="hidden" name="id_type2" value="<?php echo $id_type; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('type') ?>" class="btn btn-default">Cancel</a>
    </form>