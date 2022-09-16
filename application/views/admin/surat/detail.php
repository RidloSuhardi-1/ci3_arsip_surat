<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Arsip Surat >> Lihat</h1>
</div>

<div class="container">
    <div class="col-4">
        <div class="my-4">
            <div class="row">
                <div class="col">Nomor: </div>
                <div class="col"><?= $data['nomor_surat']; ?></div>
            </div>
            <div class="row">
                <div class="col">Kategori: </div>
                <div class="col"><?= $data['kategori']; ?></div>
            </div>
            <div class="row">
                <div class="col">Judul: </div>
                <div class="col"><?= $data['judul']; ?></div>
            </div>
            <div class="row">
                <div class="col">Waktu Unggah: </div>
                <div class="col"><?= $data['created_at']; ?></div>
            </div>
        </div>
    </div>

    <embed src="<?= base_url() . 'public/uploads/' . $data['file'] ?>" width="100%" height="400">

</div>


<div class="my-4">
    <div class="d-grid gap-2 d-md-flex justify-content-md-between">
        <div class="row">
            <div class="col">
                <a href="../" class="btn btn-success">Kembali</a>
            </div>
            <div class="col">
                <a href="<?= base_url() . 'surat/download/' . $data['id']; ?>" class="btn btn-dark">Unduh</a>
            </div>
        </div>
        <a href="<?= base_url() . 'surat/edit/' . $data['id']; ?>" class="btn btn-warning px-4">Edit</a>
    </div>
</div>