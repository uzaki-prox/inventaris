<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Ruangan Read</h2>
        <table class="table">
	    <tr><td>ID Ruangan</td><td><?php echo $id_room; ?></td></tr>
	    <tr><td>Nama Ruangan</td><td><?php echo $name_room; ?></td></tr>
	    <tr><td>PIC</td><td><?php echo $pic; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $kind; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('room') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>