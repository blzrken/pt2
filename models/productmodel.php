<?php

class ProductModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function readAll() {
        $sql = "SELECT * FROM tbl_products_a223536 ORDER BY fld_product_num ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function create($data) {
        $sql = "INSERT INTO tbl_products_a223536
            (fld_product_num, fld_product_name, fld_product_price,
             fld_product_brand, fld_product_screen_type, fld_product_storage,
             fld_product_quantity, fld_product_image)
            VALUES
            (:product_num, :product_name, :product_price,
             :product_brand, :product_screen, :product_storage,
             :product_quantity, :product_image)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':product_num', $data['product_num'], PDO::PARAM_STR);
        $stmt->bindValue(':product_name', $data['product_name'], PDO::PARAM_STR);
        $stmt->bindValue(':product_price', $data['product_price']);
        $stmt->bindValue(':product_brand', $data['product_brand'], PDO::PARAM_STR);
        $stmt->bindValue(':product_screen', $data['product_screen'], PDO::PARAM_STR);
        $stmt->bindValue(':product_storage', $data['product_storage'], PDO::PARAM_STR);
        $stmt->bindValue(':product_quantity', $data['product_quantity'], PDO::PARAM_INT);
        $stmt->bindValue(':product_image', $data['product_image'] ?? '', PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function readById($id) {
        $sql = "SELECT * FROM tbl_products_a223536 WHERE fld_product_num = :product_num";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':product_num', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $sql = "UPDATE tbl_products_a223536
            SET fld_product_num = :new_product_num,
                fld_product_name = :product_name,
                fld_product_price = :product_price,
                fld_product_brand = :product_brand,
                fld_product_screen_type = :product_screen,
                fld_product_storage = :product_storage,
                fld_product_quantity = :product_quantity,
                fld_product_image = :product_image
            WHERE fld_product_num = :original_product_num";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':original_product_num', $data['original_product_num'], PDO::PARAM_STR);
        $stmt->bindValue(':new_product_num', $data['product_num'], PDO::PARAM_STR);
        $stmt->bindValue(':product_name', $data['product_name'], PDO::PARAM_STR);
        $stmt->bindValue(':product_price', $data['product_price']);
        $stmt->bindValue(':product_brand', $data['product_brand'], PDO::PARAM_STR);
        $stmt->bindValue(':product_screen', $data['product_screen'], PDO::PARAM_STR);
        $stmt->bindValue(':product_storage', $data['product_storage'], PDO::PARAM_STR);
        $stmt->bindValue(':product_quantity', $data['product_quantity'], PDO::PARAM_INT);
        $stmt->bindValue(':product_image', $data['product_image'] ?? '', PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM tbl_products_a223536 WHERE fld_product_num = :product_num";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':product_num', $id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}

?>
