<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลเมนู</title>
    <!-- นำเข้าฟอนต์ Prompt จาก Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Prompt', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background: #ffffff;
            padding: 35px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 480px;
            transition: all 0.3s ease;
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header h2 {
            color: #1a202c;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .form-header p {
            color: #718096;
            font-size: 14px;
            margin-top: 4px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
            margin-top: 16px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            color: #2d3748;
            background-color: #f7fafc;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            outline: none;
            transition: all 0.25s ease;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #667eea;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%4a5568' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 42px;
        }

        button {
            width: 100%;
            margin-top: 30px;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.35);
            transition: all 0.25s ease;
        }

        button:hover {
            opacity: 0.95;
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.45);
        }

        button:active {
            transform: translateY(0);
        }

        /* ซ่อนแท็ก br เพื่อใช้การจัดระยะด้วย CSS */
        br {
            display: none;
        }
    </style>
</head>
<body>
<?php

$id = $_GET['id'];

include "action/connect.php";

$sql = "SELECT * FROM menus WHERE menu_id = '$id' ";

$result = mysqli_query($con, $sql);

$menu = mysqli_fetch_assoc($result);

//var_dump($menu);
?>

<form action="action/update_menu.php" method="post">

<div class="form-header">
    <h2>✏️ แก้ไขข้อมูลเมนู</h2>
    <p>อัปเดตรายละเอียดเมนูอาหารของคุณ</p>
</div>

<label for="">รหัสเมนู</label>
<input type="text" name="menu_id" value="<?= $menu['menu_id'] ?>" ><br>

<label for="">ชื่อเมนู</label>
<input type="text" name="menu_name" value="<?= $menu['menu_name'] ?>"> <br>

<label for="">ราคา</label>
<input type="text" name="menu_price" value="<?= $menu['menu_price'] ?>"> <br>

<label for="">รูปภาพ</label>
<input type="text" name="menu_image" value="<?= $menu['menu_image'] ?>"> <br>

<?php




include "action/connect.php";

$sql = "SELECT * FROM menu_types";

$result = mysqli_query($con, $sql);

?>
<label for="">ประเภทเมนู</label>
<select name="type_id">
<?php
foreach($result as $type){
?>
<option
value="<?= $type["type_id"] ?>"
<?= $type["type_id"] == $menu["type_id"] ? "selected" : ''?>
>
<?= $type["type_name"] ?>
</option>
<?php
}
?>
</select>

<br>

<button type="submit">บันทึกข้อมูล</button>


</form>

</body>
</html>