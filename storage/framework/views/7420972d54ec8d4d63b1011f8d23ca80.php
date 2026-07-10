<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Tambah Poin (Transaksi)</h4>
                </div>
                <div class="card-body">
                    <p class="mb-4">
                        Tambahkan poin untuk **<?php echo e($member->nama_pelanggan); ?>**. 
                        Saat ini memiliki **<?php echo e($member->poin_member); ?>** poin.
                        <br>
                        <small class="text-muted">Aturan: Setiap Rp 10.000 Belanja = 1 Poin</small>
                    </p>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('members.store_points', $member)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-4">
                            <label for="nominal_belanja" class="form-label fw-bold">Nominal Belanja (Rp):</label>
                            <input type="number" id="nominal_belanja" name="nominal_belanja" value="<?php echo e(old('nominal_belanja')); ?>" required class="form-control form-control-lg <?php $__errorArgs = ['nominal_belanja'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="10000">
                            <div class="form-text">Masukkan total belanja pelanggan (minimal Rp 10.000).</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success btn-lg">Hitung & Tambahkan Poin</button>
                            <a href="<?php echo e(route('members.index')); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/alex/Downloads/member-sembako-app/resources/views/members/add_points.blade.php ENDPATH**/ ?>