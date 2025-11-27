<?php
session_start();
include 'db_connect.php'; // ربط قاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = sha1($_POST['password']); // تشفير نفس ما حفظناه

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $error = "اسم المستخدم أو كلمة السر غير صحيحة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول المالك</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="../image/logoo.png" type="image/x-icon">
  <link rel="stylesheet" href="../style.css">

</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class=" login bg-white p-8 rounded shadow-md w-full max-w-sm ">
        <h2 class="text-2xl font-bold text-center mb-6">تسجيل دخول المالك</h2>

        <?php if (!empty($login_error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($login_error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-4">
                <label class="block text-gray-700">اسم المستخدم</label>
                <input type="text" name="username" required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">كلمة المرور</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <button type="submit"
                class="w-full bg-yellow-300 text-white py-2 rounded hover:bg-blue-700 transition duration-300">
                دخول
            </button>
        </form>
    </div>

</body>
</html>