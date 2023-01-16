<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Unit <?php echo form_error('id_unit') ?></label>
            <input type="text" class="form-control" name="id_unit" id="id_unit" placeholder="ID Unit" value="<?php echo $id_unit; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Unit <?php echo form_error('name_unit') ?></label>
            <input type="text" class="form-control" name="name_unit" id="name_unit" placeholder="Unit" value="<?php echo $name_unit; ?>" />
        </div>
        <input type="hidden" name="id_unit2" value="<?php echo $id_unit; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('unit') ?>" class="btn btn-default">Cancel</a>
    </form>