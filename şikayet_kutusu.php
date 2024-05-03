<!DOCTYPE html>
<html>
<head>
    <title>AeroNova - Şikayet Kutusu</title>
    <style>
        body {
            background-color: #ffc0cb; /* Pembe */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .content {
            background-color: white;
            padding: 20px;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .complaint-form {
            margin-top: 20px;
        }
        .complaint-form textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            box-sizing: border-box;
            resize: vertical;
        }
        .complaint-form button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .complaints-list {
            margin-top: 20px;
        }
        .complaint {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AeroNova - Şikayet Kutusu </h1>
        <p>Şikayetleriniz Bizim için Çok Önemli !</p>
    </div>
    
    <div class="content">
        <h2>Şikayetinizi Yazın</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $complaint = $_POST["complaint"];
            if (!empty($complaint)) {
                $complaintFile = fopen("complaints.txt", "a"); // Dosyayı aç ve sona ekle
                fwrite($complaintFile, $complaint . "\n"); // Şikayeti dosyaya ekle
                fclose($complaintFile); // Dosyayı kapat
                
                $servername = "localhost";
                $dbUsername = "root";
                $dbPassword = "21817994764";
                $dbName = "proje"; // Veritabanı adınızı girin

                $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

                // Veritabanına şikayeti kaydetme
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $complaint = $_POST["complaint"];
                    session_start();
                    $username = $_SESSION["username"];
                    
                    $sql = "INSERT INTO sikayetler (kullanici_adi, sikayet_metni) VALUES ('$username', '$complaint')";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Şikayetiniz alındı. En yakın zamanda ilgileneceğiz. Teşekkür ederiz!</p>";
                    } else {
                        echo "Hata: " . $sql . "<br>" . $conn->error;
                    }
                }

                $conn->close();
            }
        }
        ?>
        <form class="complaint-form" method="post" action="">
            <textarea name="complaint" required></textarea><br>
            <button type="submit">Gönder</button>
        </form>
        
        <div class="complaints-list">
            <h2>Gelen Şikayetler</h2>
            <?php
            // Kaydedilmiş şikayetleri sıralı bir şekilde listeleme
            $complaints = array();

            if (file_exists("complaints.txt")) {
                $complaints = file("complaints.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            }

            foreach ($complaints as $index => $complaint) {
                $complaintNumber = $index + 1;
                echo "<div class='complaint'>$complaintNumber. $complaint</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>