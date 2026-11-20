<?php

class ProductController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("productmodel");
    }

    public function index() {
        $records = $this->model->readAll();
        $this->view("products", ["products" => $records]);
    }

    public function save() {
        $data = $this->formData();
        $this->model->create($data);
        redirectTo('productcontroller');
    }

    public function edit($id) {
        $aproduct = $this->model->readById($id);
        if (!$aproduct) { abortRequest(404, 'Record not found.'); }
        $this->view("products", [
            "aproduct" => $aproduct,
            "products" => $this->model->readAll()
        ]);
    }

    public function update() {
        $data = $this->formData() + $this->fields(['original_product_num']);
        $this->model->update($data);
        redirectTo('productcontroller');
    }

    public function delete($id) {
        $aproduct = $this->model->readById($id);
        if (!$aproduct) { abortRequest(404, 'Record not found.'); }
        $this->model->delete($id);
        redirectTo('productcontroller');
    }

    private function formData() {
        $data = $this->fields(['product_num', 'product_name', 'product_price', 'product_brand', 'product_screen', 'product_storage', 'product_quantity']);
        if (!preg_match('/^[A-Za-z0-9_-]+$/D', $data['product_num'])) {
            abortRequest(422, 'Use letters, numbers, underscores or hyphens in the ID.');
        }
        if (!is_numeric($data['product_price']) || (float) $data['product_price'] < 0
            || (float) $data['product_price'] > 99999999
            || filter_var($data['product_quantity'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 2147483647]]) === false
            || !in_array($data['product_brand'], ['Amazon Kindle', 'Kobo', 'reMarkable', 'Sony Reader', 'Barnes & Noble', 'PocketBook'], true)
            || !in_array($data['product_screen'], ['E-Ink Carta', 'E-Ink Kaleido', 'Canvas Paper Display'], true)
            || !in_array($data['product_storage'], ['8 GB', '16 GB', '32 GB', '64 GB'], true)) {
            abortRequest(422, 'Check the product price, quantity and specifications.');
        }
        $image = trim((string) ($_POST['product_image'] ?? ''));
        if ($image !== '' && (!preg_match('/^[A-Za-z0-9_. -]+\.(?:jpe?g|png|webp)$/iD', $image) || strlen($image) > 255)) {
            abortRequest(422, 'Enter a valid JPG, PNG or WebP image filename.');
        }
        $data['product_image'] = $image;

        return $data;
    }
}
