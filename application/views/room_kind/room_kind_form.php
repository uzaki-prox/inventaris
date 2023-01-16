<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Jenis <?php echo form_error('id_kind') ?></label>
            <input type="text" class="form-control" name="id_kind" id="id_kind" placeholder="ID Jenis" value="<?php echo $id_kind; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="varchar">Jenis <?php echo form_error('name_kind') ?></label>
            <input type="text" class="form-control" name="name_kind" id="name_kind" placeholder="Jenis" value="<?php echo $name_kind; ?>" />
        </div>
        <input type="hidden" name="id_kind" value="<?php echo $id_kind; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('room_kind') ?>" class="btn btn-default">Cancel</a>
    </form>