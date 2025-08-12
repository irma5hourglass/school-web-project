<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">

        <li class="breadcrumb-item active">Ekstrakurikuler</li>
        <li class="breadcrumb-item"><a href="<?= site_url('auth/ekstrakurikuler') ?>">List Ekstrakurikuler</a></li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<p class="sub-title"> <button type="button" class="btn btn-primary btn-sm tambah"><i class=" fa fa-plus-circle"></i> Tambah Ekstrakurikuler</button>
</p>
<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listekstra() {
        $.ajax({
            url: "<?= site_url('ekstrakurikuler/getekstra') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listekstra();
        $('.tambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('ekstrakurikuler/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                }
            });
        });
    });
</script>
<?= $this->endSection('isi') ?>