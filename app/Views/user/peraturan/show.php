<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --success-color: #198754;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
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

    .detail-group {
        margin-bottom: 1.5rem;
    }

    .detail-group label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        padding: 0.75rem;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        font-size: 1rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 0.5rem;
        color: white;
    }

    .status-pending { background-color: var(--warning-color); color: var(--dark-color); }
    .status-published { background-color: var(--success-color); }
    .status-rejected { background-color: var(--danger-color); }

    .btn {
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .btn-primary { background-color: var(--primary-color); color: white; }
    .btn-primary:hover { background-color: #0b5ed7; }
    .btn-secondary { background-color: var(--secondary-color); color: white; }
    .btn-secondary:hover { background-color: #5c636a; }
    .btn-danger { background-color: var(--danger-color); color: white; }
    .btn-danger:hover { background-color: #bb2d3b; }
    .btn-success { background-color: var(--success-color); color: white; }
    .btn-success:hover { background-color: #157347; }

    .d-flex { display: flex; }
    .justify-content-between { justify-content: space-between; }
    .align-items-center { align-items: center; }
    .gap-2 { gap: 0.5rem; }
    .mt-4 { margin-top: 1.5rem; }
    .pt-4 { padding-top: 1.5rem; }
    .border-top { border-top: 1px solid #dee2e6; }
    .mr-2 { margin-right: 0.5rem; }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2><i class="fas fa-file-alt mr-2"></i> Detail Peraturan</h2>
        <?php
            $statusClass = '';
            switch ($peraturan['status']) {
                case 'pending': $statusClass = 'status-pending'; break;
                case 'published': $statusClass = 'status-published'; break;
                case 'rejected': $statusClass = 'status-rejected'; break;
            }
        ?>
        <span class="status-badge <?= $statusClass ?>"><?= ucfirst($peraturan['status']); ?></span>
    </div>

    <div class="detail-group">
        <label>Judul</label>
        <div class="detail-value"><?= esc($peraturan['judul']) ?></div>
    </div>

    <div class="detail-group">
        <label>Peraturan</label>
        <div class="detail-value"><?= esc($peraturan['peraturan']) ?></div>
    </div>

    <div class="detail-group">
        <label>Kategori</label>
        <div class="detail-value"><?= esc($peraturan['kategori']) ?></div>
    </div>

    <div class="detail-group">
        <label>Tanggal Upload</label>
        <div class="detail-value"><?= date('d F Y, H:i', strtotime($peraturan['created_at'])) ?> WIB</div>
    </div>

    <?php if ($peraturan['updated_at'] != $peraturan['created_at']): ?>
        <div class="detail-group">
            <label>Terakhir Diperbarui</label>
            <div class="detail-value"><?= date('d F Y, H:i', strtotime($peraturan['updated_at'])) ?> WIB</div>
        </div>
    <?php endif; ?>

    <div class="detail-group">
        <label>File Lampiran</label>
        <div class="detail-value d-flex justify-content-between align-items-center">
            <span><i class="fas fa-file-alt mr-2"></i> <?= esc($peraturan['file_lampiran']) ?></span>
            <a href="<?= base_url('user/peraturan/download/' . $peraturan['id']) ?>" class="btn btn-success">
                <i class="fas fa-download mr-2"></i> Download
            </a>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4 pt-4 border-top">
        <a href="<?= base_url('user/peraturan') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>

        <?php if ($peraturan['status'] == 'pending'): ?>
            <a href="<?= base_url('user/peraturan/edit/' . $peraturan['id']) ?>" class="btn btn-primary">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>

            <form action="<?= base_url('user/peraturan/delete/' . $peraturan['id']) ?>"
                method="post" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus peraturan ini?');">
                <input type="hidden" name="_method" value="DELETE">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash mr-2"></i> Hapus
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>