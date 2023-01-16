<?php
$label = $this->db->query("SELECT no_label FROM label")->num_rows();
//$label_rusak = $this->db->query("SELECT no_infra WHERE status='rusak' FROM qc_infratructure")->num_rows();
//$label_kb = $this->db->query("SELECT no_infra WHERE status='kurang baik' FROM qc_infratructure")->num_rows();
//$label_baik = $this->db->query("SELECT no_infra WHERE status='baik' FROM qc_infratructure")->num_rows();
$type = $this->db->query("SELECT id_type FROM type")->num_rows();
$unit = $this->db->query("SELECT id_unit FROM unit")->num_rows();
$cluster = $this->db->query("SELECT id_cluster FROM cluster")->num_rows();
$unit_cluster = ($unit + $cluster);
$cleaning = $this->db->query("SELECT id_clean FROM clean_instrument")->num_rows();
$completness = $this->db->query("SELECT id_complet FROM complet_instrument")->num_rows();
?>
<div class="alert alert-success" style="background-color: #3BAFDA; color: #fff">
  <strong>Selamat Datang , </strong> &nbsp  <?php echo $this->session->userdata('name'); ?>.
</div>
<?php
if ($this->session->userdata('id_role') == '1') {
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET</h3>
      </div>
      <div class="panel-body">
        <?php echo $label ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KEBERSIHAN</h3>
      </div>
      <div class="panel-body">
        <?php echo $cleaning ?>
      </div>
    </div>
  </div>
                    
  <div class="col-md-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KELENGKAPAN</h3>
      </div>
    <div class="panel-body">
      <?php echo $completness ?>
    </div>
  </div>
</div>

<?php
} elseif ($this->session->userdata('id_role') == '2') {
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET</h3>
      </div>
      <div class="panel-body">
        <?php echo $label ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KEBERSIHAN</h3>
      </div>
      <div class="panel-body">
        <?php echo $cleaning ?>
      </div>
    </div>
  </div>
                   
  <div class="col-md-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KELENGKAPAN</h3>
      </div>
      <div class="panel-body">
        <?php echo $completness ?>
      </div>
    </div>
  </div>
</div>

<?php
} elseif ($this->session->userdata('id_role') == '3') {
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KEBERSIHAN</h3>
      </div>
    <div class="panel-body">
      <?php echo $cleaning; ?>
    </div>
  </div>
                    
  <div class="col-md-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH POIN KELENGKAPAN</h3>
      </div>
      <div class="panel-body">
        <?php echo $completness; ?>
      </div>
    </div>
  </div>
</div>
                    
<?php
} elseif ($this->session->userdata('id_role') == '4') {
?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH KELOMPOK DAN UNIT</h3>
      </div>
      <div class="panel-body">
        <?php echo $unit_cluster; ?>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-success">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH JENIS</h3>
      </div>
      <div class="panel-body">
        <?php echo $type ?>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET</h3>
      </div>
      <div class="panel-body">
      <?php echo $label ?>
    </div>
  </div>
  
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG RUSAK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_rusak; ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG KURANG BAIK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_kb; ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG BAIK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_baik; ?>
      </div>
    </div>
  </div>
</div>
<?php
} elseif ($this->session->userdata('id_role') == '5') {
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG RUSAK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_rusak; ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG KURANG BAIK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_kb; ?>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">JUMLAH ASET YANG BAIK</h3>
      </div>
      <div class="panel-body">
        <?php// echo $label_baik; ?>
      </div>
    </div>
  </div>
</div>
<?php
}
?>