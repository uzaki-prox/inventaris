<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="varchar">ID Ruangan <?php echo form_error('id_room') ?></label>
            <input type="text" class="form-control" name="id_room" id="id_room" placeholder="ID Ruangan" value="<?php echo $id_room; ?>" readonly />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Ruangan <?php echo form_error('name_room') ?></label>
            <input type="text" class="form-control" name="name_room" id="name_room" placeholder="Nama Ruangan" value="<?php echo $name_room; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Lokasi <?php echo form_error('location') ?></label>
            <input type="text" class="form-control" name="location" id="location" placeholder="Lokasi" value="<?php echo $location; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">PIC <?php echo form_error('pic') ?></label>
            <select name="pic" class="form-control">
                <?php
                $sql1 = $this->db->get('users');
                foreach ($sql1->result() as $user) { ?>
                    <option value="<?php echo $user->niy ?>" <?php echo ($pic == $user->niy) ? 'selected' : '' ?>>(<?php echo $user->niy; ?>) <?php echo $user->name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Jenis <?php echo form_error('kind') ?></label>
            <select name="kind" class="form-control">
                <?php
                $sql2 = $this->db->get('room_kind');
                foreach ($sql2->result() as $rk) { ?>
                    <option value="<?php echo $rk->id_kind ?>" <?php echo ($kind == $rk->id_kind) ? 'selected' : '' ?>><?php echo $rk->name_kind ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('room') ?>" class="btn btn-default">Cancel</a>
    </form>