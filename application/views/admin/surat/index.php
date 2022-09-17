<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Arsip Surat</h1>
</div>

<p class="fw-normal mb-4">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>Klik "Lihat" pada kolom untuk menampilkan surat.</p>

<?php if ($this->session->flashdata('pesan')) : ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    Surat berhasil <?= $this->session->flashdata('pesan'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<form action="<?= base_url() . 'surat'; ?>" method="POST">
  <div class="input-group mb-4 w-50">
    <input type="text" name="search_by_judul" class="form-control" placeholder="Cari surat berdasarkan judul.." aria-label="Cari surat berdasarkan judul.." aria-describedby="button-addon2">
    <button class="btn btn-dark" type="submit" id="button-addon2">Cari</button>
  </div>
</form>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nomor Surat</th>
        <th scope="col">Kategori</th>
        <th scope="col">Judul</th>
        <th scope="col">Waktu Pengarsipan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1 ?>
      <?php if ($data) : ?>
        <?php foreach ($data as $x) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $x['nomor_surat'] ?></td>
            <td><?= $x['kategori'] ?></td>
            <td><?= $x['judul'] ?></td>
            <td><?= $x['created_at'] ?></td>
            <td>
              <a href="<?= base_url() . 'surat/delete/' . $x['id']; ?>" class="btn btn-danger btn-sm" aria-current="page" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
              <a href="<?= base_url() . 'surat/download/' . $x['id']; ?>" class="btn btn-dark btn-sm">Unduh</a>
              <a href="<?= base_url() . 'surat/detail/' . $x['id']; ?>" class="btn btn-primary btn-sm">Lihat</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="6" class="text-center">Belum ada data</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="mt-2">
  <a href="<?= base_url() . 'surat/tambah'; ?>" class="btn btn-primary btn-sm">Arsipkan Surat</a>
</div>