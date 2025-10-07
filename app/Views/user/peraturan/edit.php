<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --success-color: #198754;
        --danger-color: #dc3545;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    .container {
        padding: 2rem;
    }

    h2 {
        color: var(--dark-color);
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 0.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-control,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .error-msg {
        display: block;
        color: var(--danger-color);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn {
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
    }

    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-secondary {
        background-color: var(--secondary-color);
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5c636a;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-end {
        justify-content: flex-end;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }
</style>

<div class="container">
    <h2><i class="fas fa-edit mr-2"></i> <?= esc($title) ?></h2>

        <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('user/peraturan/update/' . $peraturan['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

        <div class="form-group mb-3">
            <label for="judul">Judul Peraturan <span style="color:red;">*</span></label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul', $peraturan['judul']) ?>" required>
            <?= $validation?->showError('judul', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label for="kategori">Kategori <span style="color:red;">*</span></label>
            <select id="kategori" name="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategoriData as $kat): ?>
                    <option value="<?= esc($kat) ?>" <?= old('kategori', $peraturan['kategori']) == $kat ? 'selected' : '' ?>>
                        <?= esc($kat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= $validation?->showError('kategori', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label for="peraturan">Peraturan <span style="color:red;">*</span></label>
            <input type="text" id="peraturan" name="peraturan" class="form-control" value="<?= old('peraturan', $peraturan['peraturan']) ?>" required placeholder="Contoh: Undang-Undang No. 12 Tahun 2024">
            <?= $validation?->showError('peraturan', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label>File Saat Ini</label>
            <div class="form-control" style="background-color: #e9ecef;">
                <a href="<?= base_url('user/peraturan/download/' . $peraturan['id']) ?>" class="text-decoration-none">
                    <i class="fas fa-file-alt"></i> <?= esc($peraturan['file_lampiran']) ?>
                </a>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="file_lampiran">Update File Lampiran (Opsional)</label>
            <input type="file" id="file_lampiran" name="file_lampiran" class="form-control" accept=".pdf,.doc,.docx">
            <small>Kosongkan jika tidak ingin mengubah file. PDF, DOC, DOCX (Max. 10MB)</small>
                <?= $validation?->showError('file_lampiran', 'error-msg') ?>
            </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="<?= base_url('user/peraturan') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update Peraturan</button>
            </div>
        </form>
</div>

<?= $this->endSection() ?>