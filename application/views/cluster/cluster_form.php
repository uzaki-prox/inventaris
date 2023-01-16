<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Kelompok <?php echo form_error('id_cluster') ?></label>
            <input type="text" class="form-control" name="id_cluster" id="id_cluster" placeholder="ID Jenis" value="<?php echo $id_cluster; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Jenis Kelompok <?php echo form_error('name_cluster') ?></label>
            <input type="text" class="form-control" name="name_cluster" id="name_cluster" placeholder="Jenis" value="<?php echo $name_cluster; ?>" />
        </div>
        <input type="hidden" name="id_cluster2" value="<?php echo $id_cluster; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('cluster') ?>" class="btn btn-default">Cancel</a>
    </form>