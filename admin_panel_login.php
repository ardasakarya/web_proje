<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Admin Paneli</title>
    <meta charset="UTF-8">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Sayfa taşmasını engellemek için */
        }
        .header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px 0;
        }
        .header h1 {
            font-size: 36px;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            background-color: #fafafa;
        }
        .login-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 5px;
            background-color: #333;
            color: white;
        }
        .circle {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            animation: moveCircle 20s infinite;
        }
        .title {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 5px 0;
            font-size: 24px;
        }
        @keyframes moveCircle {
            0% { transform: translate(0, 0); }
            25% { transform: translate(10vw, 10vh); }
            50% { transform: translate(20vw, 20vh); }
            75% { transform: translate(30vw, 30vh); }
            100% { transform: translate(40vw, 40vh); }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AeroNova</h1>
        <p>Zafer, Azmin İradeyle Buluştuğu Yerde Saklıdır.</p>
    </div>
    <div class="title">
        AeroNova Admin Panel
    </div>
    <div class="content">
        <div class="login-box">
            <form method="post" action="">
                <input type="text" name="kullaniciAdi" placeholder="Kullanıcı Adı" required><br>
                <input type="password" name="sifre" placeholder="Şifre" required><br>
                <button type="submit">Giriş Yap</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $kullaniciAdi = $_POST["kullaniciAdi"];
                $sifre = $_POST["sifre"];

                if ($kullaniciAdi == "admin" && $sifre == "admin") {
                    header("Location: admin_panel.php");
                    exit;
                } else {
                    echo '<div style="text-align: center; color: red; margin-top: 10px;">Kullanıcı adınız veya şifreniz yanlış!</div>';
                }
            }
            ?>
        </div>
    </div>
    <div class="footer">
        &copy; 2023 AeroNova
    </div>
    <div class="circle"></div>
</body>
</html>