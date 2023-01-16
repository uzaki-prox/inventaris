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
        <h2 style="margin-top:0px">Uraian Kebersihan</h2>
        <table class="table">
	    <tr><td>ID Kelengkapan</td><td><?php echo $id_complet; ?></td></tr>
        <tr><td>Uraian Kelengkapan</td><td><?php echo $intrument_complet; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $descript; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('complete_inst ') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>