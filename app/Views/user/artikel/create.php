<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="p-6 max-w-3xl mx-auto">
    <div class="bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-pen-nib mr-2 text-indigo-600"></i> <?= esc($title) ?>
        </h1>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/artikel/store') ?>" method="post" onsubmit="return submitForm(event);">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Artikel</label>
                <input type="text" id="title" name="title"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="<?= old('title') ?>" required>
                <?= $validation?->showError('title', 'error-msg') ?>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Konten Artikel</label>
                <div id="editor" style="height: 300px;" class="mb-2 bg-white border border-gray-300 rounded-md"></div>
                <input type="hidden" name="content" id="content-json">
                <?= $validation?->showError('content', 'error-msg') ?>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="<?= base_url('user/artikel') ?>" class="px-4 py-2 rounded-lg border text-gray-700 hover:bg-gray-100 flex items-center">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Kirim Artikel
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    header: [2, 3, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
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
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'align': []
                }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    function submitForm(e) {
        var content = JSON.stringify(quill.getContents());
        document.getElementById('content-json').value = content;
        return true;
    }

    // Restore old content if validation failed
    <?php if (old('content')): ?>
        try {
            quill.setContents(<?= old('content') ?>);
        } catch (e) {}
    <?php endif; ?>
</script>

<?= $this->endSection() ?>