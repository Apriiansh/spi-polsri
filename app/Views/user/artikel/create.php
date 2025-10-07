<?= $this->extend('layout/admin_main'); ?>
<?= $this->section('content'); ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .container { padding: 2rem; }
    h2 { color: #212529; margin-bottom: 1.5rem; border-bottom: 2px solid #0d6efd; padding-bottom: 0.5rem; }
    .form-group { margin-bottom: 1.5rem; }
    .form-control, .form-select { width: 100%; padding: 0.75rem; border: 1px solid #ced4da; border-radius: 0.5rem; }
    #editor { min-height: 300px; background-color: #fff; }
    .btn { padding: 0.75rem 1.25rem; font-weight: 600; border-radius: 0.5rem; cursor: pointer; }
    .btn-primary { background-color: #0d6efd; color: white; }
    .btn-secondary { background-color: #6c757d; color: white; }
</style>

<div class="container">
    <h2><?= esc($title); ?></h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/kegiatan/store'); ?>" method="post" onsubmit="return submitQuillForm();">
        <?= csrf_field(); ?>

        <div class="form-group mb-3">
            <label for="judul">Judul Kegiatan</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul'); ?>">
            <?= $validation?->showError('judul', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-select">
                <option value="">Pilih Kategori</option>
                <?php foreach ($kategoriData as $kategori_nama) : ?>
                    <option value="<?= esc($kategori_nama); ?>" <?= (old('kategori') == $kategori_nama) ? 'selected' : ''; ?>>
                        <?= esc($kategori_nama); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= $validation?->showError('kategori', 'error-msg') ?>
        </div>

        <div class="form-group mb-3">
            <label>Konten Kegiatan</label>
            <div id="editor"></div>
            <input type="hidden" name="konten" id="konten-json">
            <?= $validation?->showError('konten', 'error-msg') ?>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <a href="<?= base_url('admin/kegiatan'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
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
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        [{ 'align': [] }],
                        ['link', 'image'], ['clean']
                    ],
                    handlers: {
                        'image': function() {
                            const input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*';
                            input.click();
                            input.onchange = async () => {
                                const file = input.files[0];
                                const formData = new FormData();
                                formData.append('image', file);
                                try {
                                    const res = await fetch('<?= base_url('admin/kegiatan/uploadImage'); ?>', {
                                        method: 'POST',
                                        body: formData,
                                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                                    });
                                    const result = await res.json();
                                    if (result.url) {
                                        const range = quill.getSelection();
                                        quill.insertEmbed(range.index, 'image', result.url);
                                    } else alert('Gagal upload: ' + (result.error || 'Kesalahan.'));
                                } catch (e) {
                                    console.error(e);
                                    alert('Upload gagal.');
                                }
                            };
                        }
                    }
                }
            }
        });

        window.submitQuillForm = function() {
            document.getElementById('konten-json').value = JSON.stringify(quill.getContents());
            return true;
        }
    });
</script>
<?= $this->endSection(); ?>
