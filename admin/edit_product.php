<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "لا يوجد معرف منتج!";
    exit();
}

$productId = intval($_GET['id']);

// جلب بيانات المنتج
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo "المنتج غير موجود!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل منتج</title>
  <link rel="shortcut icon" href="../image/logoo.png" type="image/x-icon">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: white;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            margin-top: 25px;
            width: 100%;
            background-color: #ffcc00;
            color: #000;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e6b800;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>تعديل المنتج</h2>
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">

        <label>الاسم:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>السعر:</label>
        <input type="number" name="price" value="<?= $product['price'] ?>" step="0.01" required>

        <label>الكمية:</label>
        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>

        <label>الصنف:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label>صورة جديدة (اختياري):</label>
        <input type="file" name="image">

        <label>الحالة:</label>
        <select name="status" required>
            <option value="متوفر" <?= ($product['status'] == 'متوفر') ? 'selected' : '' ?>>متوفر</option>
            <option value="غير متوفر" <?= ($product['status'] == 'غير متوفر') ? 'selected' : '' ?>>غير متوفر</option>
        </select>

        <button type="submit">💾 تحديث المنتج</button>
    </form>

    <div class="back-link">
        <a href="admin.php">← الرجوع للوحة التحكم</a>
    </div>
</div>

</body>
</html>
