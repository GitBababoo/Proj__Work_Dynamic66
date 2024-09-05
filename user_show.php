<?php
// เชื่อมต่อกับฐานข้อมูล
include 'connect_db.php';

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
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>แสดงข้อมูลผู้ใช้</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name-Surname</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        // แสดงข้อมูลแต่ละแถว
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td><a href='user_edit.php?id=" . $row["user_id"] . "'>Edit</a></td>";
            echo "<td><a href='delete_user.php?id=" . $row["user_id"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>ไม่พบข้อมูล</td></tr>";
    }
    ?>
    </tbody>
</table>
<br>
<button onclick="document.location='user_add.php'">เพิ่มข้อมูล</button>
<br>
</body>
</html>

<?php
// ปิดการเชื่อมต่อ
$conn->close();
?>
