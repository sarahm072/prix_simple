<?php
include 'config.php';

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // حذف الصورة من السيرفر
    $getImage = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $getImage->bind_param("i", $productId);
    $getImage->execute();
    $result = $getImage->get_result();
    if ($row = $result->fetch_assoc()) {
        $imagePath = "../uploads/" . $row['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // حذف الصورة
        }
    }

    // حذف المنتج من قاعدة البيانات
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    if ($stmt->execute()) {
        header("Location: admin.php?deleted=1");
    } else {
        echo "حدث خطأ أثناء الحذف.";
    }
} else {
    echo "معرف المنتج غير موجود.";
}
?>
