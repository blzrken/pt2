<?php

class StaffController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("staffmodel");
    }

    public function index() {
        $records = $this->model->readAll();
        $this->view("staffs", ["staffs" => $records]);
    }

    public function save() {
        $data = $this->formData();
        $this->model->create($data);
        redirectTo('staffcontroller');
    }

    public function edit($id) {
        $astaff = $this->model->readById($id);
        if (!$astaff) { abortRequest(404, 'Record not found.'); }
        $this->view("staffs", [
            "astaff" => $astaff,
            "staffs" => $this->model->readAll()
        ]);
    }

    public function update() {
        $data = $this->formData() + $this->fields(['original_staff_num']);
        $this->model->update($data);
        redirectTo('staffcontroller');
    }

    public function delete($id) {
        $astaff = $this->model->readById($id);
        if (!$astaff) { abortRequest(404, 'Record not found.'); }
        $this->model->delete($id);
        redirectTo('staffcontroller');
    }

    private function formData() {
        $data = $this->fields(['staff_num', 'staff_name', 'staff_phone', 'staff_email']);
        if (!preg_match('/^[A-Za-z0-9_-]+$/D', $data['staff_num'])) {
            abortRequest(422, 'Use letters, numbers, underscores or hyphens in the ID.');
        }
        if (!filter_var($data['staff_email'], FILTER_VALIDATE_EMAIL)) {
            abortRequest(422, 'Enter a valid staff email address.');
        }

        return $data;
    }
}
