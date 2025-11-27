<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<?php
include 'db_connect.php'; 


// التحقق من وجود الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST["name"];
    $price    = $_POST["price"];
    $quantity = $_POST["quantity"];
    $category = $_POST["category"];
    $status   = $_POST["status"];

    // معالجة الصورة
    $imageName = $_FILES["image"]["name"];
    $imageTmp  = $_FILES["image"]["tmp_name"];

    // المجلد الهدف حسب النوع
    $targetDir = "image/" . $category . "/";

    // إذا ماكانش المجلد موجود، ينشئه
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // true لإنشاء مجلدات متداخلة
    }

    // المسار الكامل لحفظ الصورة
    $targetFile = $targetDir . basename($imageName);

    // محاولة نقل الصورة
    if (move_uploaded_file($imageTmp, $targetFile)) {
        // حفظ البيانات في قاعدة البيانات (فقط اسم الصورة)
        $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, category, image, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdisss", $name, $price, $quantity, $category, $imageName, $status);

        if ($stmt->execute()) {
            echo "✅ تم إضافة المنتج بنجاح.";
        } else {
            echo "❌ خطأ في حفظ المنتج: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ فشل في رفع الصورة.";
    }

    $conn->close();
}
?>
