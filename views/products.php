<?php ob_start(); ?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Products</h2>
        <p class="text-muted mb-0">Manage and track all your products</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <!-- Form Header -->
        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i> Product Form
                </h5>
                <small class="text-muted">Fill in the details of a product</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">* Required fields</span>
            </div>
        </div>

        <hr>

        <form action="<?= BASE_URL ?>productcontroller/<?= isset($aproduct) ? 'update' : 'save' ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
            <?php if (isset($aproduct)): ?>
                <input type="hidden" name="original_product_num" value="<?= e($aproduct['fld_product_num']) ?>">
            <?php endif; ?>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="pid" class="form-label">Product ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_num" maxlength="255" pattern="[A-Za-z0-9_\-]+" id="pid" type="text" class="form-control" placeholder="Enter Product ID" value="<?= e($aproduct['fld_product_num'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="name" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_name" id="name" type="text" class="form-control" placeholder="Enter Product Name" value="<?= e($aproduct['fld_product_name'] ?? '') ?>" required>
                </div>
                <div class="col-md-3">
                    <label for="price" class="form-label">Price <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_price" id="price" type="number" class="form-control" placeholder="Enter Price" value="<?= e($aproduct['fld_product_price'] ?? '') ?>" required min="0" step="0.01">
                </div>
                <div class="col-md-3">
                    <label for="brand" class="form-label">Brand <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="product_brand" id="brand" class="form-select" required>
                        <option value="">Select Brand</option>
                        <option value="Amazon Kindle" <?= ($aproduct['fld_product_brand'] ?? '') === 'Amazon Kindle' ? 'selected' : '' ?>>Amazon Kindle</option>
                        <option value="Kobo" <?= ($aproduct['fld_product_brand'] ?? '') === 'Kobo' ? 'selected' : '' ?>>Kobo</option>
                        <option value="reMarkable" <?= ($aproduct['fld_product_brand'] ?? '') === 'reMarkable' ? 'selected' : '' ?>>reMarkable</option>
                        <option value="Sony Reader" <?= ($aproduct['fld_product_brand'] ?? '') === 'Sony Reader' ? 'selected' : '' ?>>Sony Reader</option>
                        <option value="Barnes &amp; Noble" <?= ($aproduct['fld_product_brand'] ?? '') === 'Barnes & Noble' ? 'selected' : '' ?>>Barnes & Noble</option>
                        <option value="PocketBook" <?= ($aproduct['fld_product_brand'] ?? '') === 'PocketBook' ? 'selected' : '' ?>>PocketBook</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="product_screen" class="form-label">Screen Type <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="product_screen" id="product_screen" class="form-select" required>
                        <option value="">Select Screen Type</option>
                        <option value="E-Ink Carta" <?= ($aproduct['fld_product_screen_type'] ?? '') === 'E-Ink Carta' ? 'selected' : '' ?>>E-Ink Carta</option>
                        <option value="E-Ink Kaleido" <?= ($aproduct['fld_product_screen_type'] ?? '') === 'E-Ink Kaleido' ? 'selected' : '' ?>>E-Ink Kaleido</option>
                        <option value="Canvas Paper Display" <?= ($aproduct['fld_product_screen_type'] ?? '') === 'Canvas Paper Display' ? 'selected' : '' ?>>Canvas Paper Display</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="product_storage" class="form-label">Storage Capacity <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="product_storage" id="product_storage" class="form-select" required>
                        <option value="">Select Storage</option>
                        <option value="8 GB" <?= ($aproduct['fld_product_storage'] ?? '') === '8 GB' ? 'selected' : '' ?>>8 GB</option>
                        <option value="16 GB" <?= ($aproduct['fld_product_storage'] ?? '') === '16 GB' ? 'selected' : '' ?>>16 GB</option>
                        <option value="32 GB" <?= ($aproduct['fld_product_storage'] ?? '') === '32 GB' ? 'selected' : '' ?>>32 GB</option>
                        <option value="64 GB" <?= ($aproduct['fld_product_storage'] ?? '') === '64 GB' ? 'selected' : '' ?>>64 GB</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="product_quantity" id="quantity" type="number" class="form-control" placeholder="Enter Quantity" value="<?= e($aproduct['fld_product_quantity'] ?? '') ?>" required min="0">
                </div>
                <div class="col-md-3">
                    <label for="product_image" class="form-label">Image</label>
                    <input name="product_image" id="product_image" type="text" class="form-control" placeholder="Enter image filename" value="<?= e($aproduct['fld_product_image'] ?? '') ?>">
                </div>
            </div>

            <hr class="mt-4 mb-3">

            <div>
                <button type="submit" name="create" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($aproduct) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
                <?php if (isset($aproduct)): ?>
                    <a href="<?= BASE_URL ?>productcontroller" class="btn btn-outline-secondary">Cancel</a>
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
                    <i class="bi bi-table text-primary me-2"></i> Product List
                </h5>
                <small class="text-muted">View and manage all products in the inventory</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?= count($products) ?> items</span>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Brand</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= e($product['fld_product_num'] ?? '') ?></td>
                        <td><?= e($product['fld_product_name'] ?? '') ?></td>
                        <td><?= money($product['fld_product_price']) ?></td>
                        <td><?= e($product['fld_product_brand'] ?? '') ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>productcontroller/edit/<?= rawurlencode((string) $product['fld_product_num']) ?>" class="btn btn-sm btn-warning" aria-label="Edit product">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <?php if (!empty($product['fld_product_image'])): ?>
                                <a href="<?= BASE_URL ?>images/<?= rawurlencode($product['fld_product_image']) ?>" class="btn btn-sm btn-info text-white" target="_blank" rel="noopener" aria-label="Preview product image">
                                    <i class="bi bi-image"></i>
                                </a>
                            <?php endif; ?>
                            <form action="<?= BASE_URL ?>productcontroller/delete/<?= rawurlencode((string) $product['fld_product_num']) ?>" method="post" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                                <button type="submit" class="btn btn-sm btn-danger" aria-label="Delete product"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!$products): ?>
                    <tr><td colspan="5" class="text-center">No products found</td></tr>
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
