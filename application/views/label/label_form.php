<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="no_label" id="no_label" value="<?php echo $no_label; ?>" />
    <div class="form-group">
        <div class="form-group">
            <label for="varhcar">Unit <?php echo form_error('unit') ?></label>
            <select name="unit" class="form-control">
                <?php
                $sql1 = $this->db->get('unit');
                foreach ($sql1->result() as $un) { ?>
                <option value="<?php echo $un->id_unit ?>" <?php echo ($unit == $un->id_unit) ? 'selected' : '' ?>><?php echo $un->name_unit ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Kelompok <?php echo form_error('cluster') ?></label>
            <select name="cluster" class="form-control">
                <?php
                $sql2 = $this->db->get('cluster');
                foreach ($sql2->result() as $cl) { ?>
                <option value="<?php echo $cl->id_cluster ?>" <?php echo ($cluster == $cl->id_cluster) ? 'selected' : '' ?>><?php echo $cl->name_cluster ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="int">Jenis Objek <?php echo form_error('type') ?></label>
            <select name="type" class="form-control">
                <?php
                $sql3 = $this->db->get('type');
                foreach ($sql3->result() as $ty) { ?>
                <option value="<?php echo $ty->id_type ?>" <?php echo ($type == $ty->id_type) ? 'selected' : '' ?>><?php echo $ty->name_type ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Objek <?php echo form_error('object') ?></label>
            <select name="object" class="form-control">
                <?php
                $sql4 = $this->db->get('object');
                foreach ($sql4->result() as $obj) { ?>
                <option value="<?php echo $obj->id_object ?>" <?php echo ($object == $obj->id_object) ? 'selected' : '' ?>><?php echo $obj->name_object ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
        <div class="form-group">
            <label for="varchar">No Urut <?php echo form_error('serial_number') ?></label>
            <input type="int" class="form-control" name="serial_number" id="serial_number" placeholder="No Urut" value="<?php echo $serial_number; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Tahun Pengadaan <?php echo form_error('year') ?></label>
            <input type="text" class="year form-control" name="year" id="year" placeholder="Tahun Pengadaan" value="<?php echo $year; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Sumber Dana <?php echo form_error('source') ?></label>
            <input type="text" class="form-control" name="source" id="source" placeholder="Sumber Dana" value="<?php echo $source; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Ruangan <?php echo form_error('room') ?></label>
            <select name="room" class="form-control">
                <?php
                $sql5 = $this->db->get('room');
                foreach ($sql5->result() as $rm) { ?>
                <option value="<?php echo $rm->id_room ?>" <?php echo ($room == $rm->id_room) ? 'selected' : '' ?>><?php echo $rm->name_room ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('label') ?>" class="btn btn-default">Cancel</a>
    </form>