<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$password = "";
$dbname = "simple_price";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جلب منتجات فئة ملحقات الحاسوب
$sql = "SELECT * FROM products WHERE category = 'pcacce'";
$result = $conn->query($sql);
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : PHP_INT_MAX;

$sql = "SELECT * FROM products WHERE category = 'pcacce'";

if ($search !== '') {
    $sql .= " AND name LIKE '%$search%'";
}

$sql .= " AND price BETWEEN $min_price AND $max_price";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>ملحقات الحاسوب - السعر البسيط</title>
  <link rel="shortcut icon" href="image/logoo.png" type="image/x-icon">

  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #fff;
      color: #222;
    }

    header {
      background-color: #ffcc00;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header nav a {
      margin: 0 10px;
      text-decoration: none;
      color: black;
      font-weight: bold;
    }

    .products {
      padding: 40px;
      max-width: 1200px;
      margin: auto;
    }

    .products h1 {
      text-align: center;
      color: #ff9900;
      margin-bottom: 40px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
    }

    .product {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      background-color: #f9f9f9;
      text-align: center;
      transition: 0.3s;
    }

    .product:hover {
      background-color: #ffe066;
      box-shadow: 0px 20px 40px black;
    }

    .product img {
      width: 100%;
      height: 180px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .product h3 {
      margin: 10px 0 5px;
      font-size: 20px;
    }

    .product p {
      margin: 5px 0;
      font-size: 16px;
    }

    .product .btn {
      margin-top: 10px;
      display: inline-block;
      background-color: #ffcc00;
      padding: 8px 15px;
      text-decoration: none;
      color: black;
      font-weight: bold;
      border-radius: 5px;
    }

    footer {
      background-color: #222;
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<header>
  <h2>السعر البسيط</h2>
  <nav>
    <a href="index.php">الرئيسية</a>
    <a href="index.php">كل المنتجات</a>
    <a href="contact.php">اتصل بنا</a>
  </nav>
</header>

<section class="products">
  <h1>🖱️ ملحقات الحاسوب</h1>
<p style="text-align: center; font-size: 18px; margin-bottom: 15px;">
🔍 يمكنك البحث عن حاسوب حسب <strong>الاسم أو الماركة</strong>، وتحديد <strong>ميزانيتك</strong> لاختيار ما يناسبك.
</p>

<form method="GET" style="text-align: center; margin-bottom: 30px;">
  <input type="text" name="search" placeholder="🔍 ابحث عن ماركة..." value="<?php echo htmlspecialchars($search); ?>" style="padding: 8px; width: 200px;">

  <input type="number" name="min_price" placeholder="💰 من (دج)" value="<?php echo $min_price; ?>" style="padding: 8px; width: 100px;">

  <input type="number" name="max_price" placeholder="💰 إلى (دج)" value="<?php echo $max_price; ?>" style="padding: 8px; width: 100px;">

  <button type="submit" style="padding: 8px 15px; background-color: #ffcc00; border: none; border-radius: 5px; font-weight: bold;">تصفية</button>
  <a href="pcacce.php" style="margin-right: 15px; color: #070707ff; text-decoration:none;">🔄 إعادة تعيين</a>

</form>

  <div class="product-grid">
    <?php
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '
        <div class="product">
          <img src="admin/image/' . htmlspecialchars($row["category"]) . '/' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '">
          <h3>' . htmlspecialchars($row["name"]) . '</h3>
          <p>السعر: ' . htmlspecialchars($row["price"]) . ' دج</p>
          <p>الكمية: ' . htmlspecialchars($row["quantity"]) . '</p>
        </div>';
      }
    } else {
      echo "<p style='text-align:center;'>لا توجد منتجات حالياً في فئة ملحقات الحاسوب.</p>";
    }

    $conn->close();
    ?>
  </div>
</section>

<footer>
  &copy; 2025 السعر البسيط. جميع الحقوق محفوظة.
</footer>

</body>
</html>
