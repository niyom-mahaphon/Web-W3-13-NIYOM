<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เมนูอาหาร</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

      
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 950px;
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
            border: none !important; 
            margin-top: 20px;
        }

        
        th {
            background-color: #ff7675;
            color: white;
            font-weight: 500;
            padding: 16px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none !important;
        }

      
        td {
            padding: 16px;
            border-bottom: 1px solid #f1f2f6 !important;
            text-align: center;
            vertical-align: middle;
            color: #555;
            font-size: 15px;
        }

       
        tr:nth-child(even) {
            background-color: #fdfbfb;
        }

        
        tr:hover {
            background-color: #f5f6fa;
            transition: background-color 0.2s ease;
        }

        
        img {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            object-fit: cover;
            transition: transform 0.3s ease;
            max-height: 130px; 
        }

       
        img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
    <?php
    //แสดง error

// Report all PHP errors
error_reporting(E_ALL);

// Force errors to be displayed on the screen
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

        include "action/connect.php";

        //       ดึง   ทัั้งหมด จาก  ตาราง  menus
        $sql = "SELECT * FROM menus";
        //                      ที่อยู่ฐาน , คิวรี่
         $result = mysqli_query($con , $sql);
         // ทดสอบ
         // var_dump($result); 
    ?>

    <table border=1>
        <thead>
            <th>รหัสเมนู</th>
            <th>ชื่อเมนู</th>
            <th>ราคา</th>
            <th>ภาพ</th>
            <th>ประเภท</th>
        </thead>

        <?php
            foreach($result as $menu){
                ?>

                <tr>
                    <td><?= $menu["menu_id"] ?></td>
                    <td><?= $menu["menu_name"] ?></td>
                    <td><?= $menu["menu_price"] ?></td>
                    <td>
                        <img
                         src="<?= $menu["menu_image"] ?>" 
                         alt=""
                         style="width:200px"
                        >
                    </td>
                    <td><?= $menu["menu_id"] ?></td>
                </tr>
                
                <?php
            }
        ?>



    </table>

</body>
</html>