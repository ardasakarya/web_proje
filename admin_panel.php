<!DOCTYPE html>
<html>
<head>
    <title>Admin Veri</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            flex-direction: column;
            align-items: center;
            background-color: #fafafa;
            padding: 20px 0;
        }
        .table-title {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }
        .table-container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: white;
        }
        .action-buttons {
            display: flex;
            align-items: center;
        }
        .action-button {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AeroNova</h1>
        <p>Zafer, Azmin İradeyle Buluştuğu Yerde Saklıdır.</p>
    </div>
    <div class="content">
        <?php
        // Veritabanı bağlantısı ve sorgusu
        $servername = "localhost";
        $username = "root";
        $password = "21817994764";
        $database = "proje";

        // Bağlantı oluşturma
        $conn = new mysqli($servername, $username, $password, $database);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Tablo isimleri
        $tableNames = array("kullanicilar", "sikayetler");

        // Her tablo için verileri çek ve göster
        foreach ($tableNames as $tableName) {
            $sql = "SELECT * FROM $tableName";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-title">' . strtoupper($tableName) . ' TABLOSU</div>';
                echo '<div class="table-container">';
                echo '<table>';
                echo '<tr>';
                while ($fieldInfo = $result->fetch_field()) {
                    echo '<th>' . $fieldInfo->name . '</th>';
                }
                echo '<th>İşlemler</th>';
                echo '</tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    foreach ($row as $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '<td class="action-buttons">';
                    echo '<form method="post">';
                    echo '<input type="hidden" name="tableName" value="' . $tableName . '">';
                    echo '<input type="hidden" name="rowId" value="' . $row['id'] . '">'; // Burada 'id' sütun adını kendi sütun adınıza göre güncelleyin
                    echo '<button class="action-button" type="submit" name="deleteRow">Sil</button>';
                    if (isset($_POST["editRow"]) && $_POST["rowId"] == $row['id']) {
                        foreach ($row as $key => $value) {
                            echo '<input type="text" name="' . $key . '[' . $row['id'] . ']" value="' . $value . '">';
                        }
                        echo '<button class="action-button" type="submit" name="saveEdit">Bitir</button>';
                    } else {
                        echo '<button class="action-button" type="submit" name="editRow">Düzenle</button>';
                    }
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
        }
		// Silme işlemi
if (isset($_POST['deleteRow'])) {
    $tableName = $_POST['tableName'];
    $rowId = $_POST['rowId'];

    $sql = "DELETE FROM $tableName WHERE id = $rowId"; // Burada 'id' sütun adını kendi sütun adınıza göre güncelleyin
    if ($conn->query($sql) === TRUE) {
        header("Refresh:0"); // Sayfayı yenile
    } else {
        echo "Silme hatası: " . $conn->error;
    }
}

// Düzenleme kaydetme işlemi
if (isset($_POST['saveEdit'])) {
    $tableName = $_POST['tableName'];
    $rowId = $_POST['rowId'];
    
    $updateValues = array();
    foreach ($_POST as $key => $value) {
        if ($key !== 'tableName' && $key !== 'rowId' && is_array($value) && isset($value[$rowId])) {
            $updateValues[] = "$key = '{$value[$rowId]}'";
        }
    }
    
    if (!empty($updateValues)) {
        $updateQuery = "UPDATE $tableName SET " . implode(', ', $updateValues) . " WHERE id = $rowId"; // Burada 'id' sütun adını kendi sütun adınıza göre güncelleyin
        if ($conn->query($updateQuery) === TRUE) {
            header("Refresh:0"); // Sayfayı yenile
        } else {
            echo "Düzenleme kaydetme hatası: " . $conn->error;
        }
    }
}

        
        $conn->close();
        ?>
    </div>
    <div class="footer">
        &copy; 2023 AeroNova
    </div>
</body>
</html>