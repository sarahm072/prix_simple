<?php
include 'admin/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success = "✅ تم إرسال رسالتك بنجاح! شكرًا لتواصلك معنا.";
    } else {
        $error = "❌ حدث خطأ أثناء إرسال الرسالة. حاول لاحقًا.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>اتصل بنا - السعر البسيط</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="shortcut icon" href="image/logoo.png" type="image/x-icon">
</head>
<body>

<header class="header-animation">
  <h2 class="logo">السعر البسيط</h2>
  <nav>
    <a href="index.php">الرئيسية</a>
    <a href="about.php">من نحن</a>
    <a href="contact.php">اتصل بنا</a>
  </nav>
</header>

<section class="contact animate__animated animate__fadeIn">
  <h1 class="section-title">اتصل بنا</h1>
  <p class="intro-text ">مرحبا بك في متجر السعر البسيط<br>
  لمعرفة السلع المتوفرة و الأسعار يرجى التواصل معنا عبر تطبيق المسنجر او الفايبر او الواتساب عبر الرقم الآتية</p>
  
  <div class="contact-info">
    <div class="info-card">
      <h3>📞 الهاتف:</h3>
      <ul>
        <li><span>0672844807</span></li>
        <li><span>0770390232</span></li>
        <li><span>0772953168</span></li>
        <li><span>0663286087</span></li>
      </ul>
    </div>
    
    <div class="info-card">
      <h3>📍 العنوان:</h3>
      <p>Avenue de l'Indépendance, Batna, Algeria, 05000</p>
    </div>
    
    <div class="info-card">
      <h3>💬 واتساب:</h3>
      <a href="https://wa.me/213663286087" target="_blank" class="whatsapp-link">راسلنا على واتساب</a>
    </div>
    
    <div class="info-card">
      <h3>📧 البريد الإلكتروني:</h3>
      <p>karimboucharif005@gmail.com</p>
    </div>
  </div>

  <div class="contact-form">
    <?php if (isset($success)) echo "<div class='alert success animate__animated animate__bounceIn'>$success</div>"; ?>
    <?php if (isset($error)) echo "<div class='alert error animate__animated animate__shakeX'>$error</div>"; ?>
    
    <form action="#" method="post" class="form-animation">
      <div class="form-group">
        <input type="text" name="name" placeholder="الاسم الكامل" required class="input-field" />
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder="البريد الإلكتروني" required class="input-field" />
      </div>
      <div class="form-group">
        <textarea name="message" placeholder="رسالتك..." rows="5" required class="textarea-field"></textarea>
      </div>
      <button type="submit" class="submit-btn">إرسال الرسالة</button>
    </form>
  </div>

  <div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3245.8966938603166!2d6.183622324772182!3d35.55625347262785!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12f411b96dd1f697%3A0xcd0815fce3983c30!2z2KfZhNiz2LnYsSDYp9mE2KjYs9mK2Lcg2YTZhNmH2YjYp9iq2YE!5e0!3m2!1sar!2sdz!4v1754428904099!5m2!1sar!2sdz" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</section>

<footer class="footer-animation">
  &copy; 2025 السعر البسيط. جميع الحقوق محفوظة.
</footer>

</body>
</html>