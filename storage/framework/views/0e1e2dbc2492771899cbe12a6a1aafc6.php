 


<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Daftar Member Pembeli Sembako</h2>
        <a href="<?php echo e(route('members.create')); ?>" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Member Baru
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Username</th>
                            <th scope="col">WhatsApp</th>
                            <th scope="col" class="text-center">Poin Member</th>
                            <th scope="col" class="text-center">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($member->nama_pelanggan); ?></td>
                            <td><?php echo e($member->username); ?></td>
                            <td><?php echo e($member->whatsapp ?? '-'); ?></td>
                            <td class="text-center fw-bold text-primary"><?php echo e($member->poin_member); ?></td>
                            <td class="text-center">
                                <?php
                                    $badgeClass = match ($member->kategori_member) {
                                        'Gold' => 'bg-warning text-dark',
                                        'Silver' => 'bg-secondary',
                                    default => 'bg-info', // Bronze
                                    };
                                ?>
                                <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($member->kategori_member); ?></span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex item-center justify-content-center space-x-2">
                                    
                                    <a href="<?php echo e(route('members.add_points', $member)); ?>" class="btn btn-sm btn-success me-2">
                                        + Poin
                                    </a>
                                    <a href="<?php echo e(route('members.claim_points', $member)); ?>" class="btn btn-sm btn-danger me-2">
                                        Klaim
                                    </a>

                                    <a href="<?php echo e(route('members.edit', $member)); ?>" class="btn btn-sm btn-info text-white me-2">
                                        Edit
                                    </a>
                                    
                                    <form action="<?php echo e(route('members.destroy', $member)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus member ini?')" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada data member yang tersedia.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <?php echo e($members->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/alex/Downloads/member-sembako-app/resources/views/members/index.blade.php ENDPATH**/ ?>