<?php
// เชื่อมต่อกับฐานข้อมูล
include 'connect_db.php';

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$sql = "SELECT user_id, CONCAT(user_name, ' ', user_surname) AS full_name FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงข้อมูลผู้ใช้</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        a { color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
        button { padding: 10px 15px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h1>แสดงข้อมูลผู้ใช้</h1>


<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name-Surname</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        // แสดงข้อมูลแต่ละแถว
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["user_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
            echo "<td><a href='user_edit.php?id=" . urlencode($row["user_id"]) . "'>Edit</a></td>";
            echo "<td><a href='delete_user.php?id=" . urlencode($row["user_id"]) . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>ไม่พบข้อมูล</td></tr>";
    }
    ?>
    </tbody>
</table>

<br>
<button onclick="window.location.href='user_add.php'">เพิ่มข้อมูล</button>

<?php
// ปิดการเชื่อมต่อ
$conn->close();
?>

</body>
</html>
