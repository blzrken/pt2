<?php

class CustomerController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("customermodel");
    }

    public function index() {
        $records = $this->model->readAll();
        $this->view("customers", ["customers" => $records]);
    }

    public function save() {
        $data = $this->formData();
        $this->model->create($data);
        redirectTo('customercontroller');
    }

    public function edit($id) {
        $acustomer = $this->model->readById($id);
        if (!$acustomer) { abortRequest(404, 'Record not found.'); }
        $this->view("customers", [
            "acustomer" => $acustomer,
            "customers" => $this->model->readAll()
        ]);
    }

    public function update() {
        $data = $this->formData() + $this->fields(['original_customer_num']);
        $this->model->update($data);
        redirectTo('customercontroller');
    }

    public function delete($id) {
        $acustomer = $this->model->readById($id);
        if (!$acustomer) { abortRequest(404, 'Record not found.'); }
        $this->model->delete($id);
        redirectTo('customercontroller');
    }

    private function formData() {
        $data = $this->fields(['customer_num', 'customer_name', 'customer_gender', 'customer_phone']);
        if (!preg_match('/^[A-Za-z0-9_-]+$/D', $data['customer_num'])) {
            abortRequest(422, 'Use letters, numbers, underscores or hyphens in the ID.');
        }
        if (!in_array($data['customer_gender'], ['Male', 'Female'], true)) {
            abortRequest(422, 'Select a valid gender.');
        }

        return $data;
    }
}
