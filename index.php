<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการเมนูอาหาร</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Kanit', sans-serif;
            background-color: #faf7f2; /* โทนสีครีมอุ่นสไตล์ร้านอาหาร */
            background-image: radial-gradient(#e5d9cc 1px, transparent 1px);
            background-size: 20px 20px;
            color: #2d3436;
            min-height: 100vh;
            padding-bottom: 40px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-direction: column;
        }

        /* ==================== สไตล์ Navbar ==================== */
        .navbar {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #f0eae1;
            box-shadow: 0 4px 15px rgba(100, 80, 60, 0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
            margin-bottom: 35px;
        }

        .navbar-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 700;
            color: #2d3436;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand span {
            color: #d63031;
        }

        .navbar-links {
            display: flex;
            list-style: none;
            gap: 12px;
            align-items: center;
        }

        .navbar-links a {
            text-decoration: none;
            color: #636e72;
            font-size: 15px;
            font-weight: 500;
            padding: 8px 18px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        .navbar-links a:hover {
            color: #d63031;
            background: #fff5f5;
        }

        .navbar-links a.active {
            color: #ffffff;
            background: #d63031;
            box-shadow: 0 4px 12px rgba(214, 48, 49, 0.25);
        }

        @media (max-width: 600px) {
            .navbar-container {
                flex-direction: column;
                gap: 15px;
            }
            .navbar-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 6px;
            }
        }
        /* ==================================================== */

        .header-title {
            text-align: center;
            margin-bottom: 35px;
            padding: 0 20px;
        }

        .header-title h2 {
            font-size: 32px;
            font-weight: 700;
            color: #2d3436;
            letter-spacing: -0.5px;
        }

        .header-title p {
            font-size: 15px;
            color: #887766;
            margin-top: 6px;
        }

        /* ซ่อนกรอบตารางเดิม เปลี่ยนเป็นพื้นที่วางการ์ด */
        .table-container {
            width: 100%;
            max-width: 1100px;
            padding: 0 20px;
            background: transparent;
            box-shadow: none;
            border-radius: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: none !important; 
            display: block;
        }

        /* ซ่อนหัวตาราง (TH) เพราะเปลี่ยนเป็นระบบการ์ดเมนู */
        thead {
            display: none;
        }

        /* แปลง TBODY เป็น Grid Layout สำหรับวางการ์ดอาหาร */
        tbody {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 25px;
            width: 100%;
        }

        /* เปลี่ยนแถวตาราง (TR) เป็นการ์ดอาหาร 1 ใบ */
        tr {
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(100, 80, 60, 0.08);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid #f0eae1 !important;
            position: relative;
        }

        tr:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 35px rgba(232, 67, 147, 0.15);
            border-color: #ff7675 !important;
        }

        /* จัดระเบียบช่องข้อมูล (TD) ให้อยู่ตามตำแหน่งของการ์ด */
        td {
            border: none !important;
            padding: 0;
            background: transparent !important;
        }

        /* ช่องที่ 4: รูปภาพ (วางไว้บนสุดของการ์ด) */
        td:nth-child(4) {
            order: 1;
            height: 190px;
            width: 100%;
            overflow: hidden;
            background-color: #f5eedc;
        }

        img {
            width: 100% !important;
            height: 100% !important;
            max-height: none !important;
            object-fit: cover;
            border-radius: 0 !important;
            box-shadow: none !important;
            transition: transform 0.5s ease;
        }

        tr:hover img {
            transform: scale(1.08);
        }

        /* ช่องที่ 1: รหัสเมนู (แปลงเป็น Badge ป้ายกำกับบนรูป) */
        td:nth-child(1) {
            order: 2;
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(45, 52, 54, 0.75);
            backdrop-filter: blur(4px);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            z-index: 2;
        }

        td:nth-child(1)::before {
            content: "ID: ";
            opacity: 0.8;
        }

        /* ช่องที่ 2: ชื่อเมนู */
        td:nth-child(2) {
            order: 3;
            font-size: 19px;
            font-weight: 600;
            color: #2d3436;
            text-align: left;
            padding: 16px 18px 4px 18px;
        }

        /* ช่องที่ 5: ประเภทเมนู */
        td:nth-child(5) {
            order: 4;
            font-size: 13px;
            color: #a08875;
            text-align: left;
            padding: 0 18px 12px 18px;
        }

        td:nth-child(5)::before {
            content: "🏷️ ประเภท: ";
        }

        /* ช่องที่ 3: ราคาอาหาร (ตัวใหญ่เด่นชัดไว้ด้านล่าง) */
        td:nth-child(3) {
            order: 5;
            font-size: 24px;
            font-weight: 700;
            color: #d63031;
            text-align: right;
            padding: 8px 18px 18px 18px;
            margin-top: auto;
            border-top: 1px dashed #f0eae1 !important;
        }

        td:nth-child(3)::before {
            content: "฿ ";
            font-size: 18px;
        }

        td:nth-child(3)::after {
            content: " บาท";
            font-size: 14px;
            font-weight: 400;
            color: #b2bec3;
        }

        /* ตกแต่งปุ่มย้อนกลับ (bth-back) */
        .bth-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #2d3436 0%, #000000 100%);
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 50px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .bth-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
            color: #ffffff;
            background: linear-gradient(135deg, #d63031 0%, #e84393 100%);
        }

        .bth-back:active {
            transform: translateY(0);
        }

        /* ==================== สไตล์สำหรับ Footer ==================== */
        .site-footer {
            width: calc(100% - 40px);
            max-width: 1100px;
            margin-top: 50px;
            padding: 25px 20px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(100, 80, 60, 0.05);
            border: 1px solid #f0eae1;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #f0eae1;
        }

        .footer-info h4 {
            font-size: 16px;
            color: #2d3436;
            font-weight: 600;
        }

        .footer-info p {
            font-size: 13px;
            color: #887766;
            margin-top: 2px;
        }

        .footer-contact {
            font-size: 13px;
            color: #636e72;
            text-align: right;
        }

        .footer-copyright {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #b2bec3;
        }

        @media (max-width: 600px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
            .footer-contact {
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- ================= Navbar Section ================= -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">
                🍽️ <span>Menu</span>Showcase
            </a>
            <ul class="navbar-links">
                <li><a href="index.php">หน้าแรก</a></li>
                <li><a href="show_menu.php" class="active">รายการเมนู</a></li>
                <li><a href="manage_menu.php">จัดการเมนู</a></li>
                <li><a href="#footer">ติดต่อเรา</a></li>
            </ul>
        </div>
    </nav>
    <!-- =================================================== -->

    <div class="header-title">
        <h2>✨ Menu Showcase</h2>
        <p>รายการเมนูอาหารแสนอร่อยที่พร้อมให้บริการ</p>
    </div>
    
    <?php
    // แสดง error
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    include "action/connect.php";

    // ดึงทั้งหมด จาก ตาราง menus
    $sql = "SELECT * FROM menus";
    //ประมวณผล
    $result = mysqli_query($con , $sql);
    ?>

    <div class="table-container">
        <!-- ส่วนหัวของตาราง -->
        <table border=1>
            <thead>
                <th>รหัสเมนู</th>
                <th>ชื่อเมนู</th>
                <th>ราคา</th>
                <th>ภาพ</th>
                <th>ประเภท</th>
            </thead>

            <!-- แสดงผลข้อมูลในตารางแบบอัตโนมัติ -->
            <?php
                 // วนลูป
                foreach($result as $menu){
                    ?>
                    <!-- สร้างแถวและช่องสำหรับใส่ข้อมูล -->
                    <tr>
                        <td><?= $menu["menu_id"] ?></td>
                        <td><?= $menu["menu_name"] ?></td>
                        <td><?= $menu["menu_price"] ?></td>
                        <td>
                            <!-- ดึงรูปภาพของเมนูมาแสดงผล -->
                            <img src="<?= $menu["menu_image"] ?>" alt="" style="width:200px">
                        </td>
                        <td><?= $menu["menu_id"] ?></td>
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>

    <a href="manage_menu.php" class="bth-back">← กลับหน้าจัดการเมนู</a>

    <!-- Footer Section -->
    <footer class="site-footer" id="footer">
        <div class="footer-content">
            <div class="footer-info">
                <h4>🍽️ ร้านอาหารของคุณ</h4>
                <p>คัดสรรวัตถุดิบคุณภาพ เพื่อรสชาติที่ดีที่สุด</p>
            </div>
            <div class="footer-contact">
                <p>📍 เปิดให้บริการทุกวัน: 10:00 - 21:00 น.</p>
                <p>📞 ติดต่อสอบถาม: 08X-XXX-XXXX</p>
            </div>
        </div>
        <div class="footer-copyright">
            <p>&copy; <?= date("Y") ?> Menu Showcase. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>