<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายการเมนู</title>
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
            color: #2d3748;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 6px;
            margin-top: 14px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            color: #2d3748;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        input[type="text"]:focus,
        select:focus {
            border-color: #ff6b6b;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.2);
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%4a5568' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
        }

        button {
            width: 100%;
            margin-top: 28px;
            padding: 12px;
            background-color: #ff6b6b;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
            transition: all 0.2s ease-in-out;
        }

        button:hover {
            background-color: #ee5253;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(255, 107, 107, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* ซ่อนแท็ก br เดิมเพื่อความสวยงามของการจัดระยะ */
        br {
            display: none;
        }
    </style>
</head>
<body>
    
    <form action="action/insert_menu.php" method="post">
            
            <div class="form-header">
                <h2>เพิ่มข้อมูลเมนูอาหาร</h2>
            </div>

            <label for="">รหัสเมนู</label>
            <input type="text" name="menu_id" placeholder="กรอกรหัสเมนู"> <br>

            <label for="">ชื่อเมนู</label>
            <input type="text" name="menu_name" placeholder="กรอกชื่อเมนู"> <br>

            <label for="">ราคา</label>
            <input type="text" name="menu_price" placeholder="กรอกราคา"> <br>

            <label for="">ภาพ</label>
            <input type="text" name="menu_image" placeholder="ใส่ลิงก์รูปภาพ"> <br>

            
            <?php

            // แสดง error

            // Report all PHP errors
            error_reporting(E_ALL);

            // Force errors to be displayed on the screen
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);


            include "action/connect.php";
            //ดึงทั้งหมดจากตาราง
            $sql = "SELECT * FROM menu_types";   

            $result = mysqli_query($con , $sql); 
            ?>

            <label for="">ประเภทเมนู</label>
            <select name="type_id">
                    <?php
                        foreach($result as $type){
                            ?>
                                <option value="<?= $type["type_id"] ?>"> <?= $type["type_name"] ?> </option>
                            <?php
                        }
                    ?>
            </select>

            <br>

            <button type="submit">บันทึกข้อมูล</button>

    </form>

</body>
</html>