<?php

class OrderController extends Controller {
    private $orderModel;
    private $customerModel;
    private $staffModel;

    public function __construct() {
        $this->orderModel = $this->model("ordermodel");
        $this->customerModel = $this->model("customermodel");
        $this->staffModel = $this->model("staffmodel");
    }

    public function index() {
        $this->view("orders", [
            "orders" => $this->orderModel->readAll(),
            "customers" => $this->customerModel->readAll(),
            "staffs" => $this->staffModel->readAll()
        ]);
    }

    public function save() {
        $data = $this->formData();
        $this->orderModel->create($data);
        redirectTo('ordercontroller');
    }

    public function edit($id) {
        $order = $this->orderModel->readById($id);
        if (!$order) { abortRequest(404, 'Record not found.'); }
        $this->view("orders", [
            "aorder" => $order,
            "orders" => $this->orderModel->readAll(),
            "customers" => $this->customerModel->readAll(),
            "staffs" => $this->staffModel->readAll()
        ]);
    }

    public function update() {
        $data = $this->formData() + $this->fields(['order_num']);
        $this->orderModel->update($data);
        redirectTo('ordercontroller');
    }

    public function delete($id) {
        $order = $this->orderModel->readById($id);
        if (!$order) { abortRequest(404, 'Record not found.'); }
        $this->orderModel->delete($id);
        redirectTo('ordercontroller');
    }

    public function invoice($id) {
        $order = $this->orderModel->readById($id);
        if (!$order) { abortRequest(404, 'Record not found.'); }
        $detailModel = $this->model("orderdetailmodel");
        $details = $detailModel->readByOrder($id);
        $this->view("invoice", [
            "order" => $order,
            "details" => $details
        ]);
    }

    private function formData() {
        $data = $this->fields(['order_date', 'staff_num', 'customer_num']);
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $data['order_date']);
        if (!$date || $date->format('Y-m-d') !== $data['order_date']
            || !$this->customerModel->readById($data['customer_num'])
            || !$this->staffModel->readById($data['staff_num'])) {
            abortRequest(422, 'Enter a valid date, customer and staff member.');
        }

        return $data;
    }
}
