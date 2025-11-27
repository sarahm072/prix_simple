<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    // تحميل الصورة إن وُجدت
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        $targetPath = "../uploads/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetPath);

        // تحديث الصورة مع باقي الحقول
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=?, category=?, image=?, status=? WHERE id=?");
        $stmt->bind_param("sdisssi", $name, $price, $quantity, $category, $image, $status, $id);
    } else {
        // بدون تحديث الصورة
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, quantity=?, category=?, status=? WHERE id=?");
        $stmt->bind_param("sdissi", $name, $price, $quantity, $category, $status, $id);
    }

    if ($stmt->execute()) {
        header("Location: admin.php?updated=1");
    } else {
        echo "فشل في التحديث!";
    }
}
?>
