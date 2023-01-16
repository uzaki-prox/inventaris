<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Asset <?php echo form_error('id_asset') ?></label>
            <input type="text" class="form-control" name="id_asset" id="id_asset" placeholder="ID Jenis" value="<?php echo $id_asset; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="varchar">Jenis Asset <?php echo form_error('name_asset') ?></label>
            <input type="text" class="form-control" name="name_asset" id="name_asset" placeholder="Jenis" value="<?php echo $name_asset; ?>" />
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('asset') ?>" class="btn btn-default">Cancel</a>
    </form>