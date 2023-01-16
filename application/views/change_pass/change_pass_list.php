<div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            
        </div>
        <table class="table">
        <tr>
            <td style="width: 50px;">NIY</td>
            <td style="width: 10px;">:</td>
            <td><?php echo $change_pass_data->niy ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $change_pass_data->name ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><?php echo $change_pass_data->place_birth ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?php echo $change_pass_data->date_birth ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $change_pass_data->address ?></td>
        </tr>
        <tr>
            <td><?php echo anchor(site_url('change_pass/cpw'),'Change Password','class="btn btn-danger"'); ?></td>
        </tr>
        </table>
        