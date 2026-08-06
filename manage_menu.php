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
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Prompt', sans-serif;
    }

    body {
        background: #0f172a; /* พื้นหลังสี Dark Slate */
        background-image: radial-gradient(rgba(217, 119, 6, 0.12) 1px, transparent 1px);
        background-size: 28px 28px;
        color: #f8fafc;
        min-height: 100vh;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* หัวข้อส่วนการจัดการ */
    body::before {
        content: "⚙️ ระบบจัดการเมนูอาหาร";
        font-size: 28px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    /* ตกแต่งปุ่ม "เพิ่มเมนู" */
    body > a[href="add_menu.php"] {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        color: #ffffff;
        text-decoration: none;
        padding: 12px 26px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 6px 20px rgba(217, 119, 6, 0.35);
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
        box-shadow: 0 10px 25px rgba(217, 119, 6, 0.5);
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    /* ตกแต่งตารางข้อมูล */
    table {
        width: 100%;
        max-width: 1100px;
        border-collapse: separate;
        border-spacing: 0;
        background: #1e293b;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }

    thead th {
        background: #0f172a;
        color: #f59e0b; /* โทนสีทอง */
        font-size: 15px;
        font-weight: 600;
        padding: 18px 16px;
        text-align: center;
        border-bottom: 2px solid rgba(245, 158, 11, 0.2) !important;
        letter-spacing: 0.5px;
    }

    tbody tr {
        transition: all 0.25s ease;
    }

    tbody tr:hover {
        background-color: rgba(245, 158, 11, 0.05);
    }

    td {
        padding: 16px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        color: #cbd5e1;
        font-size: 14px;
    }

    tbody tr:last-child td {
        border-bottom: none !important;
    }

    /* สไตล์ราคา */
    td:nth-child(3) {
        font-weight: 600;
        color: #10b981;
        font-size: 16px;
    }

    td:nth-child(3)::before {
        content: "฿ ";
        font-size: 13px;
        color: #94a3b8;
    }

    /* สไตล์รูปภาพ */
    img {
        width: 140px !important;
        height: 90px !important;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    img:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    /* สไตล์ปุ่มในช่องจัดการ */
    td:last-child {
        white-space: nowrap;
    }

    td:last-child a {
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        margin: 0 4px;
        transition: all 0.25s ease;
    }

    /* ปุ่มแก้ไข */
    td:last-child a[href*="edit_menu"] {
        background: rgba(59, 130, 246, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    td:last-child a[href*="edit_menu"]:hover {
        background: #3b82f6;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        transform: translateY(-2px);
    }

    /* ปุ่มลบ */
    td:last-child a[href*="delete_menu"] {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    td:last-child a[href*="delete_menu"]:hover {
        background: #ef4444;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }
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

</body>
</html>