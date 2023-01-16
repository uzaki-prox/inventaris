<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">ID Kebersihan <?php echo form_error('id_clean') ?></label>
        <input type="text" class="form-control" name="id_clean" id="id_clean" placeholder="ID Kebersihan" value="<?php echo $id_clean; ?>" readonly />
    </div>
    <div class="form-group">
        <label for="varchar">Uraian Kebersihan <?php echo form_error('instrument_clean') ?></label>
        <input type="text" class="form-control" name="instrument_clean" id="instrument_clean" placeholder="Uraian Kebersihan" value="<?php echo $instrument_clean; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Keterangan <?php echo form_error('descript') ?></label>
        <input type="text" class="form-control" name="descript" id="descript" placeholder="Keterangan" value="<?php echo $descript; ?>" />
    </div>
    <input type="hidden" name="id_clean" value="<?php echo $id_clean; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('clean_inst') ?>" class="btn btn-default">Cancel</a>
</form>