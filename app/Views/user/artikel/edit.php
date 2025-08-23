<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="container mx-auto max-w-2xl p-6 pb-16">
    <div class="bg-white shadow-xl rounded-2xl px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= esc($title) ?></h1>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('user/artikel/update/' . $article['id']) ?>" method="post" onsubmit="return submitForm(event);">
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Artikel</label>
                <input type="text" id="title" name="title"
                    class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    value="<?= old('title', $article['title']) ?>" required>
                <?= $validation?->showError('title', 'error-msg') ?>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Konten Artikel</label>
                <div id="editor" style="height: 300px;" class="mb-2 bg-white"></div>
                <input type="hidden" name="content" id="content-json">
                <?= $validation?->showError('content', 'error-msg') ?>
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <a href="<?= base_url('user/artikel') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update Artikel</button>
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
                    header: [1, 2, false]
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

    // Isi konten saat edit
    <?php if (old('content', $article['content'])): ?>
        try {
            quill.setContents(<?= old('content', $article['content']) ?>);
        } catch (e) {}
    <?php endif; ?>
</script>
<?= $this->endSection() ?>