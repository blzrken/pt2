<?php

class OrderDetailController extends Controller {
    private $detailModel;
    private $orderModel;
    private $productModel;

    public function __construct() {
        $this->detailModel = $this->model('orderdetailmodel');
        $this->orderModel = $this->model('ordermodel');
        $this->productModel = $this->model('productmodel');
    }

    public function index($orderNum) {
        $this->showOrder($orderNum);
    }

    public function save() {
        $data = $this->lineItem() + $this->fields(['order_num']);
        if (!filter_var($data['order_num'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]])
            || !$this->detailModel->create($data)) {
            abortRequest(404, 'Order not found.');
        }
        $this->backToOrder($data['order_num']);
    }

    public function edit($id) {
        $detail = $this->findDetail($id);
        $this->showOrder($detail['fld_order_num'], ['adetail' => $detail]);
    }

    public function update() {
        $data = $this->lineItem() + $this->fields(['detail_num', 'order_num']);
        $detail = $this->findDetail($data['detail_num']);
        if ((string) $detail['fld_order_num'] !== $data['order_num']) {
            abortRequest(404, 'Line item not found for this order.');
        }
        $this->detailModel->update($data);
        $this->backToOrder($detail['fld_order_num']);
    }

    public function delete($id) {
        $detail = $this->findDetail($id);
        $this->detailModel->delete($id);
        $this->backToOrder($detail['fld_order_num']);
    }

    private function findDetail($id) {
        $detail = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]])
            ? $this->detailModel->readById($id) : false;
        if (!$detail) {
            abortRequest(404, 'Line item not found.');
        }
        return $detail;
    }

    private function showOrder($orderNum, array $extra = []) {
        $order = $this->orderModel->readById($orderNum);
        if (!$order) {
            abortRequest(404, 'Order not found.');
        }
        $this->view('orderdetails', [
            'order' => $order,
            'details' => $this->detailModel->readByOrder($orderNum),
            'products' => $this->productModel->readAll(),
        ] + $extra);
    }

    private function lineItem() {
        $data = $this->fields(['product_num', 'quantity']);
        if (!filter_var($data['quantity'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]])
            || !$this->productModel->readById($data['product_num'])) {
            abortRequest(422, 'Select an existing product and enter a positive whole quantity.');
        }
        return $data;
    }

    private function backToOrder($orderNum) {
        redirectTo('orderdetailcontroller/index/' . (int) $orderNum);
    }
}
