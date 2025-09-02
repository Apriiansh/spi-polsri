<?= $this->extend('layout/admin_main'); ?>
<?= $this->section('content'); ?>

<!-- Quill.js CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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

    .gap-2 {
        gap: 0.5rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
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
            <label class="block mb-1 text-sm font-medium text-gray-700">Konten Kegiatan</label>
            <div id="editor"></div>
            <input type="hidden" name="konten" id="konten-html">
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
<!-- Quill.js Library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Quill init ---
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        'list': 'ordered'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'align': []
                    }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Load konten lama
        var existingContent = `<?= $kegiatan['konten']; ?>`;
        quill.root.innerHTML = existingContent;

        // Upload gambar custom
        quill.getModule('toolbar').addHandler('image', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                const formData = new FormData();
                formData.append('image', file);

                try {
                    const response = await fetch('<?= base_url('admin/kegiatan/uploadImage'); ?>', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    const result = await response.json();

                    if (result.url) {
                        const range = quill.getSelection();
                        quill.insertEmbed(range.index, 'image', result.url);
                    } else {
                        alert('Gagal mengunggah gambar: ' + (result.error || 'Terjadi kesalahan.'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal mengunggah gambar.');
                }
            };
        });

        // Submit form
        window.submitQuillForm = function() {
            document.getElementById('konten-html').value = quill.root.innerHTML;
            return true;
        }
    });
</script>
<?= $this->endSection(); ?>