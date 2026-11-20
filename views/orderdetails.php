<?php
$orderNum = (int) $order['fld_order_num'];
$back = BASE_URL . 'orderdetailcontroller/index/' . $orderNum;
$grandTotal = 0;
ob_start();
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Order Details</h2>
        <p class="text-muted mb-0">Order #<?= $orderNum ?> for <?= e($order['fld_customer_name'] ?? $order['fld_customer_num']) ?></p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-4"><strong>Order Date</strong><br><?= e($order['fld_order_date']) ?></div>
            <div class="col-md-4"><strong>Staff</strong><br><?= e($order['fld_staff_name'] ?? $order['fld_staff_num']) ?></div>
            <div class="col-md-4"><strong>Customer</strong><br><?= e($order['fld_customer_name'] ?? $order['fld_customer_num']) ?></div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3"><i class="bi bi-cart-plus text-primary me-2"></i><?= isset($adetail) ? 'Edit Product' : 'Add Product' ?></h5>
        <hr>
        <form action="<?= BASE_URL ?>orderdetailcontroller/<?= isset($adetail) ? 'update' : 'save' ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
            <?php if (isset($adetail)): ?>
                <input type="hidden" name="detail_num" value="<?= e($adetail['fld_order_detail_num']) ?>">
            <?php endif; ?>
            <input type="hidden" name="order_num" value="<?= $orderNum ?>">
            <div class="row g-3">
                <div class="col-md-8">
                    <label for="product_num" class="form-label">Product <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="product_num" id="product_num" class="form-select" required>
                        <option value="">Select Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= e($product['fld_product_num']) ?>" data-price="<?= e($product['fld_product_price']) ?>" <?= ($adetail['fld_product_num'] ?? '') === $product['fld_product_num'] ? 'selected' : '' ?>>
                                <?= e($product['fld_product_name']) ?> (Stock = <?= e($product['fld_product_quantity']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="quantity" class="form-label">Quantity <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="quantity" id="quantity" type="number" class="form-control" min="1" value="<?= e($adetail['fld_order_detail_quantity'] ?? 1) ?>" required>
                </div>
            </div>
            <div class="mt-3">Line total <output id="line-total" for="product_num quantity">RM 0.00</output></div>
            <hr class="mt-4 mb-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i><?= isset($adetail) ? 'Update Product' : 'Add Product' ?></button>
            <a href="<?= e($back) ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="bi bi-table text-primary me-2"></i>Products in Order</h5>
            <a href="<?= BASE_URL ?>ordercontroller/invoice/<?= $orderNum ?>" class="btn btn-success"><i class="bi bi-receipt me-1"></i>View Invoice</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $detail): ?>
                        <?php
                        $detailNum = (int) $detail['fld_order_detail_num'];
                        $lineTotal = round((float) $detail['fld_product_price'], 2) * (int) $detail['fld_order_detail_quantity'];
                        $grandTotal += $lineTotal;
                        ?>
                        <tr>
                            <td><?= e($detail['fld_product_name'] ?? $detail['fld_product_num']) ?></td>
                            <td><?= money($detail['fld_product_price']) ?></td>
                            <td><?= e($detail['fld_order_detail_quantity']) ?></td>
                            <td><?= money($lineTotal) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>orderdetailcontroller/edit/<?= $detailNum ?>" class="btn btn-sm btn-warning" aria-label="Edit line item"><i class="bi bi-pencil"></i></a>
                                <form action="<?= BASE_URL ?>orderdetailcontroller/delete/<?= $detailNum ?>" method="post" class="d-inline" onsubmit="return confirm('Remove this product from the order?');">
                                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" aria-label="Delete line item"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$details): ?>
                        <tr><td colspan="5" class="text-center">No products added to this order</td></tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Grand Total</th>
                        <th><?= money($grandTotal) ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <a href="<?= BASE_URL ?>ordercontroller" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to Orders</a>
    </div>
</div>

<script>
const product = document.getElementById('product_num');
const quantity = document.getElementById('quantity');
const lineTotal = document.getElementById('line-total');
const currency = new Intl.NumberFormat('en-MY', { style: 'currency', currency: 'MYR' });

function updateLineTotal() {
    const unitPrice = Number(product.selectedOptions[0]?.dataset.price || 0);
    lineTotal.value = currency.format(unitPrice * (quantity.valueAsNumber || 0));
}

product.addEventListener('change', updateLineTotal);
quantity.addEventListener('input', updateLineTotal);
updateLineTotal();
</script>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>
