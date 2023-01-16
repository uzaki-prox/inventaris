<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Old Password <?php echo form_error('psw_lama') ?></label>
        <input type="password" class="form-control" name="psw_lama" id="psw_lama" placeholder="Old Password" value="<?php echo $psw_lama ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">New Password <?php echo form_error('password') ?></label>
        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" value="<?php echo $password ?>"/>
    </div>
    <div class="form-group">
        <label for="varchar">Confirm New Password <?php echo form_error('psw_conf') ?></label>
        <input type="password" class="form-control" name="psw_conf" id="psw_conf" placeholder="Confirm New Password" value="<?php echo $psw_conf ?>" />
    </div>
    <input type="hidden" name="niy" value="<?php echo $this->session->userdata('niy'); ?>" /> 
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    <a href="<?php echo site_url('change_pass') ?>" class="btn btn-default">Cancel</a>
</form>