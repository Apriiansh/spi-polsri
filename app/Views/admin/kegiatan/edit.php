<?= $this->extend('layout/admin_main'); ?>
<?= $this->section('content'); ?>

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

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
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

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        border: 1px solid transparent;
    }

    .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
    }

    .dynamic-block {
        border: 1px solid #e9ecef;
        background-color: var(--light-color);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .dynamic-block .btn-danger {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }

    .dynamic-image-preview {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin-top: 0.5rem;
    }
</style>

<div class="container">
    <h2><?= esc($title); ?></h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/kegiatan/update/' . $kegiatan['id']); ?>" method="post">
        <?= csrf_field(); ?>

        <!-- Judul -->
        <div class="form-group mb-3">
            <label for="judul">Judul Kegiatan</label>
            <input type="text" id="judul" name="judul" class="form-control" value="<?= old('judul', $kegiatan['judul']); ?>">
            <?= $validation?->showError('judul', 'error-msg') ?>
        </div>

        <!-- Kategori -->
        <div class="form-group mb-3">
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" class="form-select">
                <option value="">Pilih Kategori</option>
                <?php foreach (array_keys($kategoriData) as $kategori_nama) : ?>
                    <option value="<?= esc($kategori_nama); ?>" <?= old('kategori', $kegiatan['kategori']) == $kategori_nama ? 'selected' : ''; ?>> 
                        <?= esc($kategori_nama); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?= $validation?->showError('kategori', 'error-msg') ?>
        </div>

        <!-- Sub Kategori -->
        <div class="form-group mb-3">
            <label for="sub_kategori">Sub Kategori</label>
            <select id="sub_kategori" name="sub_kategori" class="form-select">
                <option value="">Pilih Sub Kategori</option>
            </select>
            <?= $validation?->showError('sub_kategori', 'error-msg') ?>
        </div>

        <!-- Konten (dynamic JSON) -->
        <div class="form-group mb-3">
            <label>Konten Kegiatan</label>
            <div id="konten-wrapper" class="mb-2"></div>
            <input type="hidden" name="konten" id="konten-json" value='<?= old('konten', $kegiatan['konten']) ?: "[]" ?>'>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addBlock('paragraph')">+ Paragraf</button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addBlock('image')">+ Gambar</button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addBlock('list')">+ List</button>
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex justify-content-end gap-2">
            <a href="<?= base_url('admin/kegiatan'); ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriData = <?= json_encode($kategoriData); ?>;
        const kategoriSelect = document.getElementById('kategori');
        const subKategoriSelect = document.getElementById('sub_kategori');
        
        const selectedKategori = "<?= old('kategori', $kegiatan['kategori']); ?>";
        const selectedSubKategori = "<?= old('sub_kategori', $kegiatan['sub_kategori']); ?>";

        function populateSubKategori(kategori, subKategori) {
            subKategoriSelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';
            if (kategori && kategoriData[kategori]) {
                kategoriData[kategori].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    if (sub === subKategori) {
                        option.selected = true;
                    }
                    subKategoriSelect.appendChild(option);
                });
            }
        }

        kategoriSelect.addEventListener('change', function() {
            populateSubKategori(this.value, null);
        });

        if (selectedKategori) {
            kategoriSelect.value = selectedKategori;
            populateSubKategori(selectedKategori, selectedSubKategori);
        }

        // --- Dynamic Content Functions ---
        let kontenData = JSON.parse(document.getElementById('konten-json').value);

        function renderBlocks() {
            const wrapper = document.getElementById('konten-wrapper');
            wrapper.innerHTML = '';
            kontenData.forEach((block, index) => {
                const el = document.createElement('div');
                el.className = 'dynamic-block';
                let innerHtml = '';

                if (block.type === 'paragraph') {
                    innerHtml = `
                        <textarea class="form-control" placeholder="Tulis paragraf di sini" oninput="updateBlock(${index}, this.value)">${block.content}</textarea>
                    `;
                } else if (block.type === 'image') {
                    innerHtml = `
                        <label>Unggah Gambar</label>
                        <input type="file" class="form-control mb-2" accept="image/*" onchange="handleImageUpload(event, ${index})">
                        ${block.content ? `<img src="${block.content}" class="dynamic-image-preview" alt="Image Preview">` : ''}
                    `;
                } else if (block.type === 'list') {
                    innerHtml = `
                        <textarea class="form-control" placeholder="Pisahkan item dengan enter" oninput="updateBlock(${index}, this.value)">${Array.isArray(block.content) ? block.content.join('\n') : ''}</textarea>
                    `;
                }

                el.innerHTML = `
                    <div class="d-flex justify-content-end gap-2 mb-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary ${index === 0 ? 'disabled' : ''}" onclick="moveBlock(${index}, -1)">Naik</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary ${index === kontenData.length - 1 ? 'disabled' : ''}" onclick="moveBlock(${index}, 1)">Turun</button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeBlock(${index})">Hapus</button>
                    </div>
                    ${innerHtml}
                `;
                wrapper.appendChild(el);
            });
            document.getElementById('konten-json').value = JSON.stringify(kontenData);
        }

        window.handleImageUpload = function(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                kontenData[index].content = e.target.result;
                renderBlocks();
            };
            reader.readAsDataURL(file);
        }

        window.addBlock = function(type) {
            let newContent = type === 'list' ? [] : '';
            kontenData.push({
                type,
                content: newContent
            });
            renderBlocks();
        }

        window.updateBlock = function(index, value) {
            if (kontenData[index].type === 'list') {
                kontenData[index].content = value.split('\n');
            } else {
                kontenData[index].content = value;
            }
            document.getElementById('konten-json').value = JSON.stringify(kontenData);
        }

        window.removeBlock = function(index) {
            kontenData.splice(index, 1);
            renderBlocks();
        }

        window.moveBlock = function(index, direction) {
            if ((direction === -1 && index === 0) || (direction === 1 && index === kontenData.length - 1)) {
                return; // Cannot move further
            }
            const item = kontenData.splice(index, 1)[0];
            kontenData.splice(index + direction, 0, item);
            renderBlocks();
        }

        // Initial render
        renderBlocks();
    });
</script>
<?= $this->endSection(); ?>