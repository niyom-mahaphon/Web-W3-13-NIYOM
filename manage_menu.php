<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>จัดการเมนูอาหาร</title>
<!-- นำเข้าฟอนต์ Prompt เพิ่มความหรูหราทันสมัย -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-color: #f8f4ef;
        --card-bg: #ffffff;
        --text-dark: #2b2118;
        --text-muted: #8c7a6b;
        --accent-primary: #e05638;
        --accent-hover: #c0392b;
        --border-color: #ede6dd;
        --dark-espresso: #211915;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Prompt', sans-serif;
    }

    body {
        background-color: var(--bg-color);
        background-image: radial-gradient(#e2d7c9 1px, transparent 1px);
        background-size: 24px 24px;
        color: var(--text-dark);
        min-height: 100vh;
        padding: 50px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* หัวข้อส่วนการจัดการ */
    body::before {
        content: "⚙️ ระบบจัดการเมนูอาหาร";
        font-size: 32px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 24px;
        letter-spacing: -0.5px;
    }

    /* ตกแต่งปุ่ม "เพิ่มเมนู" */
    body > a[href="add_menu.php"] {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #e05638 0%, #c0392b 100%);
        color: #ffffff;
        text-decoration: none;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 8px 20px rgba(224, 86, 56, 0.25);
        transition: all 0.3s ease;
        margin-bottom: 24px;
        width: 100%;
        max-width: 1100px;
    }

    body > a[href="add_menu.php"]::before {
        content: "✚ ";
        font-size: 16px;
    }

    body > a[href="add_menu.php"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(224, 86, 56, 0.4);
        background: linear-gradient(135deg, #f06548 0%, #e05638 100%);
    }

    /* ตกแต่งตารางข้อมูล */
    table {
        width: 100%;
        max-width: 1100px;
        border-collapse: separate;
        border-spacing: 0;
        background: var(--card-bg);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(43, 33, 24, 0.06);
        border: 1px solid var(--border-color) !important;
    }

    thead th {
        background: var(--dark-espresso);
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        padding: 18px 16px;
        text-align: center;
        border-bottom: 3px solid var(--accent-primary) !important;
        letter-spacing: 0.5px;
    }

    tbody tr {
        transition: all 0.25s ease;
    }

    tbody tr:hover {
        background-color: #fcf9f5;
    }

    td {
        padding: 16px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color) !important;
        color: var(--text-dark);
        font-size: 14px;
    }

    tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* สไตล์ราคา */
    td:nth-child(3) {
        font-weight: 700;
        color: var(--accent-primary);
        font-size: 17px;
    }

    td:nth-child(3)::before {
        content: "฿ ";
        font-size: 14px;
        color: var(--text-muted);
    }

    /* สไตล์รูปภาพ */
    img {
        width: 130px !important;
        height: 85px !important;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(43, 33, 24, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid var(--border-color);
    }

    img:hover {
        transform: scale(1.06);
        box-shadow: 0 8px 20px rgba(224, 86, 56, 0.2);
    }

    /* สไตล์ปุ่มในช่องจัดการ */
    td:last-child {
        white-space: nowrap;
    }

    td:last-child a {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        margin: 0 4px;
        transition: all 0.25s ease;
    }

    /* ปุ่มแก้ไข */
    td:last-child a[href*="edit_menu"] {
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, 0.2);
    }

    td:last-child a[href*="edit_menu"]:hover {
        background: #2563eb;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transform: translateY(-2px);
    }

    /* ปุ่มลบ */
    td:last-child a[href*="delete_menu"] {
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
        border: 1px solid rgba(220, 38, 38, 0.2);
    }

    td:last-child a[href*="delete_menu"]:hover {
        background: #dc2626;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        transform: translateY(-2px);
    }

    /* ตกแต่งปุ่มย้อนกลับ (bth-back) */
    .bth-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 35px;
        padding: 14px 36px;
        background: var(--dark-espresso);
        color: #ffffff;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        border-radius: 50px;
        box-shadow: 0 8px 20px rgba(33, 25, 21, 0.15);
        transition: all 0.3s ease;
    }

    .bth-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(224, 86, 56, 0.25);
        color: #ffffff;
        background: var(--accent-primary);
    }

    .bth-back:active {
        transform: translateY(0);
    }

    /* ==================== สไตล์สำหรับ Footer ==================== */
        .site-footer {
            width: 100%;
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
</style>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include "action/connect.php";

$sql = "SELECT * FROM menus";
$result = mysqli_query($con, $sql);
?>

<a href="add_menu.php">เพิ่มเมนู</a>

<table border=1>
<thead>
<th>รหัสเมนู</th>
<th>ชื่อเมนู</th>
<th>ราคา</th>
<th>ภาพ</th>
<th>ประเภท</th>
<th>จัดการ</th>
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
<td><?= $menu["type_id"] ?></td>

<td>
<!-- แก้ไข -->

<a href="edit_menu.php?id=<?=$menu["menu_id"]?>">แก้ไข</a>

<!-- ลบ -->

<a href="action/delete_menu.php?id=<?=$menu["menu_id"]?>">ลบ</a>

</td>

</tr>
<?php
}
?>

</table>

     <a href="index.php" class="bth-back">← กลับหน้าเมนู</a>


     <!-- Footer Section -->
    <footer class="site-footer">
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