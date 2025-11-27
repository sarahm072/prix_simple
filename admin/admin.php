<?php include 'db_connect.php'; ?>
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>لوحة تحكم المالك</title>
  <link rel="stylesheet" href="../style.css"> 
  <link rel="shortcut icon" href="../image/logoo.png" type="image/x-icon">
</head>
<body>

<header>لوحة تحكم المالك</header>
<div class="container">

  <div class="top-bar">
    <a href="../index.php">🏠 الرجوع للموقع</a>
  </div>

  <!-- قسم تصفية المنتجات -->
  <h2>🔎 تصفية حسب الصنف:</h2>
  <select id="categoryFilter" onchange="filterProducts()">
    <option value="all">كل المنتجات</option>
    <option value="phones">📱 هواتف</option>
    <option value="earphones">🎧 سماعات</option>
    <option value="tablets">📟 طابلات</option>
    <option value="pc">💻 الحواسيب</option>
    <option value="pcacce">🖱️ ملحقات</option>
    <option value="accessories">🧩 إكسسوارات</option>
  </select>

  <!-- جدول المنتجات -->
  <table>
    <thead>
      <tr>
        <th>الصورة</th>
        <th>الاسم</th>
        <th>السعر</th>
        <th>الكمية</th>
        <th>الصنف</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody id="productTable">
      <?php
      include 'config.php'; 
      $result = $conn->query("SELECT * FROM products");
      while ($row = $result->fetch_assoc()) {
        echo "<tr data-category='{$row['category']}'>";
        echo "<td><img src='uploads/{$row['image']}' alt='' width='60'></td>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['price']} دج</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['category']}</td>";
        echo "<td class='actions'>
                <a href='edit_product.php?id={$row['id']}' class='edit'>تعديل</a>
                <a href='delete_product.php?id={$row['id']}' class='delete'>حذف</a>
              </td>";
        echo "</tr>";
      }
      ?>
    </tbody>
  </table>

  <!-- زر إضافة منتج -->
  <div class="add-product">
    <a href="add_product.php">➕ إضافة منتج جديد</a>
  </div>

  <!-- 📨 قسم الرسائل من الزبائن -->
  <hr style="margin: 40px 0;">

  <h2>📨 رسائل الزبائن</h2>

  <table>
    <thead>
      <tr>
        <th>الاسم</th>
        <th>البريد الإلكتروني</th>
        <th>الرسالة</th>
        <th>تاريخ الإرسال</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
      if ($messages->num_rows > 0) {
        while ($msg = $messages->fetch_assoc()) {
          echo "<tr>";
          echo "<td>{$msg['name']}</td>";
          echo "<td>{$msg['email']}</td>";
          echo "<td>{$msg['message']}</td>";
          echo "<td>{$msg['created_at']}</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>لا توجد رسائل بعد.</td></tr>";
      }
      ?>
    </tbody>
  </table>

</div>

<script>
function filterProducts() {
  var filter = document.getElementById("categoryFilter").value;
  var rows = document.querySelectorAll("#productTable tr");

  rows.forEach(function(row) {
    if (filter === "all" || row.getAttribute("data-category") === filter) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  });
}
</script>

</body>
</html>
