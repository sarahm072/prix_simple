<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>إضافة منتج جديد</title>
    <link rel="shortcut icon" href="../image/logoo.png" type="image/x-icon">

  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background-color: #f4f4f4;
      padding: 30px;
      direction: rtl;
    }
    form {
      background: white;
      padding: 25px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      background-color: #27ae60;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      width: 100%;
    }
    button:hover {
      background-color: #219150;
    }
  </style>
</head>
<body>

<h2>➕ إضافة منتج جديد</h2>

<form action="insert_product.php" method="POST" enctype="multipart/form-data">
  <label>اسم المنتج:</label>
  <input type="text" name="name" required />

  <label>السعر:</label>
  <input type="number" name="price" required />

  <label>الكمية:</label>
  <input type="number" name="quantity" required />

  <label>الصنف:</label>
  <select name="category" required>
    <option value="phones">📱 هواتف</option>
    <option value="pc">💻 الحواسيب</option>
    <option value="tablets">📟 طابلات</option>
    <option value="earphones">🎧 سماعات</option>
    <option value="pcacce">🖱️ ملحقات الحاسوب</option>
    <option value="accessories">🧩 إكسسوارات</option>
  </select>

  <label>الحالة:</label>
  <select name="status" required>
    <option value="متوفر">✅ متوفر</option>
    <option value="غير متوفر">❌ غير متوفر</option>
  </select>

  <label>صورة المنتج:</label>
  <input type="file" name="image" accept="image/*" required />

  <button type="submit">إضافة المنتج</button>
</form>

</body>
</html>
