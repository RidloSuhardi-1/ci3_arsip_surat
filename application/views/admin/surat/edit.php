<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Arsip Surat >> Unggah</h1>
</div>

<p class="fw-normal mb-4 clearfix">Unggah surat yang telah terbit pada form ini untuk diarsipkan.Catatan:</p>

<div class="alert alert-primary pb-1" role="alert">
    <strong>Catatan</strong>
    <p class="mt-2">Gunakan file berformat PDF</p>
</div>

<form action="<?= base_url() . 'surat/edit/' . $data['id']; ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
    <input type="hidden" name="old_nomor" value="<?= $data['nomor_surat']; ?>">

    <div class="row g-2">
        <div class="col-sm-6">
            <label for="nomor_surat" class="form-label">Nomor Surat</label>
            <input name="nomor_surat" type="text" class="form-control mb-2 <?= (form_error('nomor_surat')) ? 'is-invalid' : ''; ?>" id="nomor_surat" placeholder="" value="<?= set_value('nomor_surat', $data['nomor_surat']); ?>" required>
            <span class="text-danger"><?= form_error('nomor_surat'); ?></span>
        </div>
        <div class="col-sm-6">
            <label for="judul" class="form-label">Judul</label>
            <input name="judul" type="text" class="form-control mb-2 <?= (form_error('judul')) ? 'is-invalid' : ''; ?>" id="judul" placeholder="" value="<?= set_value('judul', $data['judul']); ?>" required>
            <span class="text-danger"><?= form_error('judul'); ?></span>
        </div>
        <div class="col-sm-6">
            <label for="kategori" class="form-label">Kategori (sebelumnya: <?= $data['kategori']; ?>)</label>
            <select name="kategori" class="form-select" aria-label="kategori">
                <option value="Undangan" selected>Undangan</option>
                <option value="Pengumuman">Pengumuman</option>
                <option value="Nota Dinas">Nota Dinas</option>
                <option value="Pemberitahuan">Pemberitahuan</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label for="file_surat" class="form-label">File Surat (PDF)</label>
            <input name="file_surat" type="file" class="form-control form-control mb-2 <?= ($this->session->flashdata('error_file')) ? 'is-invalid' : ''; ?>" id="file_surat">

            <?php if ($this->session->flashdata('error_file')) : ?>
                <span class="text-danger">
                    <?= $this->session->flashdata('error_file'); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>


    <div class="my-4">
        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
            <a href="../" class="btn btn-success">Kembali</a>
            <button class="btn btn-primary" type="submit">Perbarui</button>
        </div>
    </div>
</form>