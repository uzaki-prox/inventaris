<form id="form" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="no_deprec" id="no_deprec" value="<?php echo $no_deprec; ?>" />      
        <div class="form-group">
            <label for="varchar">Kode Barang <?php echo form_error('no_label') ?></label>
            <select name="no_label" class="form-control">
                <?php
                $sql1 = $this->db->get('label');
                foreach ($sql1->result() as $lb) { ?>
                <option value="<?php echo $lb->no_label ?>" <?php echo ($no_label == $lb->no_label) ? 'selected' : '' ?>><?php echo $lb->unit ?>.<?php echo $lb->cluster ?>.<?php echo $lb->type ?>.<?php echo $lb->object ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varhcar">Tahun Pengadaan <?php echo form_error('year_procurement') ?></label>
            <input type="text" class="form-control" name="year_procurement" id="year_procurement" placeholder="Tahun Pengadaan" value="<?php echo $lb->year; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="varchar">Umur Ekonomi <?php echo form_error('economics_age') ?></label>
            <input type="int" class="form-control" name="economics_age" id="economics_age" placeholder="Umur Ekonomi" value="<?php echo $economics_age; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Harga Perolehan <?php echo form_error('acquisition_cost') ?></label>
            <input type="text" class="form-control" name="acquisition_cost" id="rupiah" placeholder="Harga Perolehan" value="<?php echo  $acquisition_cost; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Penyusutan Per Tahun <?php echo form_error('dep_per_year') ?></label>
            <input type="int" class="form-control" name="dep_per_year" id="dep_per_year" placeholder="Penyusutan Per Tahun" value="<?php echo $dep_per_year; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Sisa Umur <?php echo form_error('remaining_age') ?></label>
            <input type="int" class="form-control" name="remaining_age" id="remaining_age" placeholder="Sisa Umur" value="<?php echo $remaining_age; ?>" />
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('deprec') ?>" class="btn btn-default">Cancel</a>
    </form>