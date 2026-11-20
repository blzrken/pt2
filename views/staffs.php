<?php ob_start(); ?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Staffs</h2>
        <p class="text-muted mb-0">Manage staff records</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <!-- Form Header -->
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Staff Form
                </h5>
                <small class="text-muted">Fill in the details of a staff</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>

        <hr>

        <form action="<?= BASE_URL ?>staffcontroller/<?= isset($astaff) ? 'update' : 'save' ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
            <?php if (isset($astaff)): ?>
                <input type="hidden" name="original_staff_num" value="<?= e($astaff['fld_staff_num']) ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="sid" class="form-label">Staff ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="staff_num" maxlength="255" pattern="[A-Za-z0-9_\-]+" id="sid" type="text" class="form-control" placeholder="Enter Staff ID" value="<?= e($astaff['fld_staff_num'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="sname" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="staff_name" id="sname" type="text" class="form-control" placeholder="Enter Staff Name" value="<?= e($astaff['fld_staff_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="sphone" class="form-label">Phone Number <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="staff_phone" id="sphone" type="text" class="form-control" placeholder="Enter Phone Number" value="<?= e($astaff['fld_staff_phone'] ?? '') ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="staff_email" class="form-label">Email <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="staff_email" id="staff_email" type="email" class="form-control" placeholder="Enter Email Address" value="<?= e($astaff['fld_staff_email'] ?? '') ?>" required>
                </div>
            </div>

            <hr class="mt-4 mb-3">

            <div>
                <button type="submit" name="create" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($astaff) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
                <?php if (isset($astaff)): ?>
                    <a href="<?= BASE_URL ?>staffcontroller" class="btn btn-outline-secondary">Cancel</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-table text-primary me-2"></i> Staff List
                </h5>
                <small class="text-muted">View and manage all staffs</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?= count($staffs) ?> items</span>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($staffs as $staff): ?>
                    <tr>
                        <td><?= e($staff['fld_staff_num'] ?? '') ?></td>
                        <td><?= e($staff['fld_staff_name'] ?? '') ?></td>
                        <td><?= e($staff['fld_staff_phone'] ?? '') ?></td>
                        <td><?= e($staff['fld_staff_email'] ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>staffcontroller/edit/<?= rawurlencode((string) $staff['fld_staff_num']) ?>" class="btn btn-sm btn-warning" aria-label="Edit staff">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?= BASE_URL ?>staffcontroller/delete/<?= rawurlencode((string) $staff['fld_staff_num']) ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this staff?');">
                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger" aria-label="Delete staff"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!$staffs): ?>
                    <tr><td colspan="5" class="text-center">No staff found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>
