<?= $this->extend('layout/admin_main'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.container {
    padding: 2rem;
}

h2 {
    color: #212529;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 0.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control,
.form-select {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    font-size: 1rem;
}

.form-control:focus,
.form-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.error-msg {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.btn {
    padding: 0.75rem 1.25rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    font-weight: 600;
}

.btn-primary {
    background-color: #0d6efd;
    color: white;
}

.btn-primary:hover {
    background-color: #0b5ed7;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background-color: #5c636a;
}

#editor {
    min-height: 300px;
    background-color: #fff;
}
</style>

<div class="container">
    <h2><?= esc($title); ?></h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/kegiatan/update/' . $kegiatan['id']); ?>" method="post" onsubmit="return submitQuillForm();">
        <?= csrf_field(); ?>

        <div class="form-group mb-3">
            <label for="judul">Judul Kegiatan</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul', $kegiatan['judul']); ?>">
            <?= $validation?->showError('judul', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-select">
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategoriData as $kategori_nama) : ?>
                    <option value="<?= esc($kategori_nama); ?>" <?= (old('kategori', $kegiatan['kategori']) == $kategori_nama) ? 'selected' : ''; ?>>
                        <?= esc($kategori_nama); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= $validation?->showError('kategori', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label>Konten Kegiatan</label>
            <div id="editor"></div>
            <input type="hidden" name="konten" id="konten-json" value='<?= esc($kegiatan['konten']); ?>'>
            <?= $validation?->showError('konten', 'error-msg') ?>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="<?= base_url('admin/kegiatan'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'align': [] }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    try {
        const existingContent = JSON.parse(document.getElementById('konten-json').value);
        quill.setContents(existingContent);
    } catch (error) {
        console.warn('Konten lama tidak valid JSON, editor kosongkan.');
    }

    window.submitQuillForm = function() {
        const delta = quill.getContents();
        if (quill.getText().trim().length === 0) {
            alert('Konten kegiatan tidak boleh kosong.');
            return false;
        }
        document.getElementById('konten-json').value = JSON.stringify(delta);
        return true;
    }
});
</script>
<?= $this->endSection(); ?>
