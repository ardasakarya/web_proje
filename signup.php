<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website with Login & Registration Form</title>
    <link rel="stylesheet" href="style_login.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>
  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#" class="nav_logo">CodingLab</a>

        <ul class="nav_items">
          <li class="nav_item">
            <a href="#" class="nav_link">Home</a>
            <a href="#" class="nav_link">Product</a>
            <a href="#" class="nav_link">Services</a>
            <a href="#" class="nav_link">Contact</a>
          </li>
        </ul>

        <button class="button" id="form-open">Login</button>
      </nav>
    </header>

    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>

        <?php
         
        $hata = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $sifre = $_POST["sifre"];

            // Veritabanı bağlantısı ve sorgusu
            $servername = "localhost"; // Sunucu adı veya IP adresi
            $username = "root"; // MySQL kullanıcı adı
            $password = "21817994764"; // MySQL şifresi
            $database = "proje"; // Kullanmak istediğiniz veritabanı adı

            // Bağlantı oluşturma
            $conn = new mysqli($servername, $username, $password, $database);

            // Bağlantıyı kontrol etme
            if ($conn->connect_error) {
                die("Bağlantı hatası: " . $conn->connect_error);
            }

            // Kullanıcıyı veritabanında ara
            $sql = "SELECT * FROM kullanicilar WHERE email = '$email' AND sifre = '$sifre'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                session_start();
                $_SESSION["username"] = $email;
                echo "Giriş başarılı!";
            } else {
                $hata = "Kullanıcı adı veya şifre yanlış.";
            }
            if ($result->num_rows > 0) {
                header("Location: anasayfa.php"); // Başarılı giriş durumunda yönlendirilecek sayfa
                exit;
            } else {
                $hata = "Kullanıcı adı veya şifre yanlış.";
            }

            // Bağlantıyı kapatma
            $conn->close();
        }
        ?>

        <?php if ($hata) { ?>
            <p style="color: red;"><?php echo $hata; ?></p>
        <?php } ?>
        <!-- Login From -->
           <div class="form login_form">
          
            <h2>Login</h2>
     
            
            <form method="post" action="" class="login-form">
          
          <div class="input_box">
               <label for="email"></label>
                 <i class="uil uil-envelope-alt email"></i>
               <input type="email" id="email" name="email" placeholder="Email Adresi" required><br><br>
        </div>
        <div class="input_box">
               <label for="sifre"></label>
                <i class="uil uil-lock password"></i>
               <input type="password" id="sifre" name="sifre" placeholder="Şifre" required><br><br>
        </div>
             
              
              
              
               <div class="option_field">
              <span class="checkbox">
                <input type="checkbox" id="check" />
                <label for="check">Remember me</label>
              </span>
              <a href="#" class="forgot_pw">Forgot password?</a>
            </div>
            
            <input class="button"  type="submit" value="Gönder">

            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
       
           </form>
        </div>
           










        <!-- Signup From -->
        <div class="container">
        <div class="register-box">
		<div class="form signup_form">
            <h2>Kayıt Ol</h2>
			
            <?php
            $kullaniciAdi = $sifre = $sifreTekrar = $email = "";
            $hata = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $kullaniciAdi = $_POST["kullaniciAdi"];
                $sifre = $_POST["sifre"];
                $sifreTekrar = $_POST["sifreTekrar"];
                $email = $_POST["email"];

                if ($sifre != $sifreTekrar) {
                    $hata = "Girdiğiniz şifreler uyuşmuyor.";
                } else {
                    // Veritabanı bağlantısı ve sorgusu
                    $servername = "localhost"; // Sunucu adı veya IP adresi
                    $username = "root"; // MySQL kullanıcı adı
                    $password = "21817994764"; // MySQL şifresi
                    $database = "proje"; // Kullanmak istediğiniz veritabanı adı

                    // Bağlantı oluşturma
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Bağlantıyı kontrol etme
                    if ($conn->connect_error) {
                        die("Bağlantı hatası: " . $conn->connect_error);
                    }

                    // Kullanıcıyı veritabanına ekle
                    $sql = "INSERT INTO kullanicilar (kullanici_adi, sifre, email) VALUES ('$kullaniciAdi', '$sifre', '$email')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p style='color:#00ff00;'>Kaydınız başarılı bir şekilde gerçekleştirilmiştir.</p>";
                    } else {
                        echo "Hata: " . $sql . "<br>" . $conn->error;
                    }

                    // Bağlantıyı kapatma
                    $conn->close();
                }
            }
            ?>

            <?php if ($hata) { ?>
                <p style="color: red;"><?php echo $hata; ?></p>
            <?php } ?>
            
            <form method="post" action="" class="register-form">
				<div class="input_box">
				<i class="uil uil-user"></i>

                <label for="kullaniciAdi"></label>
                <input type="text" id="kullaniciAdi" name="kullaniciAdi" placeholder="Kullanıcı Adı" required><br><br>
				</div>
				 <div class="input_box">
				<label for="email"></label>
                 <i class="uil uil-envelope-alt email"></i>
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Email Adresi" required><br><br>
				</div>
				<div class="input_box">
				<label for="sifre"></label>
                <i class="uil uil-lock password"></i>
                <label for="sifre"></label>
                <input type="password" id="sifre" name="sifre" placeholder="Şifre" required><br><br>
				</div>
				<div class="input_box">
				<label for="sifre"></label>
                <i class="uil uil-lock password"></i>
                <label for="sifreTekrar"></label>
                <input type="password" id="sifreTekrar" name="sifreTekrar" placeholder="Şifre Tekrar" required><br><br>
				</div>
				
                <input class="button" type="submit" value="Gönder">
                <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
            </form>
        </div>
    </div>
	</div>
    </section>

    <script src="script.js"></script>
  </body>
</html>
