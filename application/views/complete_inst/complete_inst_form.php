<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">ID Kelengkapan <?php echo form_error('id_complet') ?></label>
        <input type="text" class="form-control" name="id_complet" id="id_complet" placeholder="ID Kelengkapan" value="<?php echo $id_complet; ?>" readonly />
    </div>
    <div class="form-group">
        <label for="varchar">Uraian Kelengkapan <?php echo form_error('instrument_complet') ?></label>
        <input type="text" class="form-control" name="instrument_complet" id="instrument_complet" placeholder="Uraian Kelengkapan" value="<?php echo $instrument_complet; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Keterangan <?php echo form_error('descript') ?></label>
        <input type="text" class="form-control" name="descript" id="descript" placeholder="Keterangan" value="<?php echo $descript; ?>" />
    </div>
    <input type="hidden" name="id_complet" value="<?php echo $id_complet; ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('complete_inst') ?>" class="btn btn-default">Cancel</a>
</form>