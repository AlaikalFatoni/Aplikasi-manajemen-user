<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Klaim Penukaran Poin</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info text-center">
                        Member: **<?php echo e($member->nama_pelanggan); ?>** | 
                        Poin Tersedia: **<?php echo e($member->poin_member); ?> Poin**
                        <br>
                        <small class="text-muted">Contoh Reward: 100 Poin = Rp 10.000 Diskon</small>
                    </div>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('members.redeem_points', $member)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-4">
                            <label for="poin_to_redeem" class="form-label fw-bold">Jumlah Poin yang Ditukar:</label>
                            <input type="number" id="poin_to_redeem" name="poin_to_redeem" value="<?php echo e(old('poin_to_redeem')); ?>" required class="form-control form-control-lg <?php $__errorArgs = ['poin_to_redeem'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" min="100" max="<?php echo e($member->poin_member); ?>">
                            <div class="form-text">Masukkan jumlah poin yang akan diklaim (minimal 100 poin).</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger btn-lg">Tukar & Kurangi Poin</button>
                            <a href="<?php echo e(route('members.index')); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/alex/Downloads/member-sembako-app/resources/views/members/claim_points.blade.php ENDPATH**/ ?>