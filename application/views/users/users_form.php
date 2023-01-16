<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="int">NIY <?php echo form_error('niy') ?></label>
        <input type="text" class="form-control" name="niy" id="niy" placeholder="NIY" value="<?php echo $niy; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Nama Pegawai <?php echo form_error('name') ?></label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Pegawai" value="<?php echo $name; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Tempat Lahir <?php echo form_error('place_birth') ?></label>
        <input type="text" class="form-control" name="place_birth" id="place_birth" placeholder="Tempat Lahir" value="<?php echo $place_birth; ?>" />
    </div>
    <div class="form-group">
        <label for="date">Tanggal Lahir <?php echo form_error('date_birth') ?></label>
        <input type="text" class="date form-control" name="date_birth" id="date_birth" placeholder="Tanggal Lahir" value="<?php echo $date_birth; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Alamat <?php echo form_error('address') ?></label>
        <input type="text" class="form-control" name="address" id="address" placeholder="Alamat" value="<?php echo $address; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Password <?php echo form_error('password') ?></label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" />
    </div>
    <div class="form-group">
        <label for="int">Hak Akses <?php echo form_error('id_role') ?></label>
        <select name="id_role" class="form-control">
            <?php
            $sql = $this->db->get('role');
            foreach ($sql->result() as $row) { ?>
            <option value="<?php echo $row->id_role ?>" <?php echo ($id_role == $row->id_role) ? 'selected' : '' ?>><?php echo $row->name_role ?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('users') ?>" class="btn btn-default">Cancel</a>
</form>