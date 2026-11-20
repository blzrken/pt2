<?php ob_start(); ?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Customers</h2>
        <p class="text-muted mb-0">Manage customer records</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <!-- Form Header -->
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Customer Form
                </h5>
                <small class="text-muted">Fill in the details of a customer</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>

        <hr>

        <form action="<?= BASE_URL ?>customercontroller/<?= isset($acustomer) ? 'update' : 'save' ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
            <?php if (isset($acustomer)): ?>
                <input type="hidden" name="original_customer_num" value="<?= e($acustomer['fld_customer_num']) ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="cid" class="form-label">Customer ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_num" maxlength="255" pattern="[A-Za-z0-9_\-]+" id="cid" type="text" class="form-control" placeholder="Enter Customer ID" value="<?= e($acustomer['fld_customer_num'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="cname" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_name" id="cname" type="text" class="form-control" placeholder="Enter Customer Name" value="<?= e($acustomer['fld_customer_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="cgender" class="form-label">Gender <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="customer_gender" id="cgender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= ($acustomer['fld_customer_gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= ($acustomer['fld_customer_gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cphone" class="form-label">Phone Number <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_phone" id="cphone" type="text" class="form-control" placeholder="Enter Phone Number" value="<?= e($acustomer['fld_customer_phone'] ?? '') ?>" required>
                </div>
            </div>

            <hr class="mt-4 mb-3">

            <div>
                <button type="submit" name="create" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($acustomer) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
                <?php if (isset($acustomer)): ?>
                    <a href="<?= BASE_URL ?>customercontroller" class="btn btn-outline-secondary">Cancel</a>
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
                    <i class="bi bi-table text-primary me-2"></i> Customer List
                </h5>
                <small class="text-muted">View and manage all customers</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?= count($customers) ?> items</span>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= e($customer['fld_customer_num'] ?? '') ?></td>
                        <td><?= e($customer['fld_customer_name'] ?? '') ?></td>
                        <td><?= e($customer['fld_customer_gender'] ?? '') ?></td>
                        <td><?= e($customer['fld_customer_phone'] ?? '') ?></td>
                        <td><?= e($customer['fld_customer_register_date'] ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>customercontroller/edit/<?= rawurlencode((string) $customer['fld_customer_num']) ?>" class="btn btn-sm btn-warning" aria-label="Edit customer">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="<?= BASE_URL ?>customercontroller/delete/<?= rawurlencode((string) $customer['fld_customer_num']) ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this customer?');">
                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger" aria-label="Delete customer"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!$customers): ?>
                    <tr><td colspan="6" class="text-center">No customers found</td></tr>
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
