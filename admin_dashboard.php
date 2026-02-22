<?php
include "config.php";

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
    echo "Access Denied";
    exit();
}

// Handle admin actions
if (isset($_GET['delete_product'])) {
    $id = intval($_GET['delete_product']);
    $conn->query("DELETE FROM products WHERE id = $id");
    header('Location: admin_dashboard.php');
    exit();
}

if (isset($_GET['resolve_request'])) {
    $rid = intval($_GET['resolve_request']);
    $conn->query("UPDATE repair_requests SET status = 'resolved' WHERE id = $rid");
    header('Location: admin_dashboard.php');
    exit();
}

// Counts
$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$products = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$repairs = $conn->query("SELECT COUNT(*) as total FROM repair_requests")->fetch_assoc()['total'];

// Lists
$productList = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 20");
$userList = $conn->query("SELECT id, full_name, email, role FROM users ORDER BY id DESC LIMIT 20");
$repairList = $conn->query("SELECT * FROM repair_requests ORDER BY id DESC LIMIT 20");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="dashboard.php">User Dashboard</a>
    <a href="add_product.php">Add Product</a>
    <a href="products.php">View Store</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="container">
<h2>Admin Dashboard</h2>

<div class="stats">
    <div class="card">Total Users: <?php echo (int)$users; ?></div>
    <div class="card">Total Products: <?php echo (int)$products; ?></div>
    <div class="card">Repair Requests: <?php echo (int)$repairs; ?></div>
</div>

<h3 style="margin-top:24px;">Recent Products</h3>
<table style="width:100%;border-collapse:collapse;margin-bottom:18px">
    <thead>
        <tr style="text-align:left;border-bottom:1px solid #eee">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while($p = $productList->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$p['id']; ?></td>
            <td><?php echo htmlspecialchars($p['product_name']); ?></td>
            <td>₦<?php echo htmlspecialchars($p['price']); ?></td>
            <td><?php echo htmlspecialchars($p['stock']); ?></td>
            <td>
                <a href="add_product.php?edit=<?php echo (int)$p['id']; ?>">Edit</a> |
                <a href="admin_dashboard.php?delete_product=<?php echo (int)$p['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<h3>Recent Repair Requests</h3>
<table style="width:100%;border-collapse:collapse;margin-bottom:18px">
    <thead>
        <tr style="text-align:left;border-bottom:1px solid #eee">
            <th>ID</th>
            <th>User</th>
            <th>Device</th>
            <th>Problem</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while($r = $repairList->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$r['id']; ?></td>
            <td><?php echo htmlspecialchars($r['user_name'] ?? $r['user_email'] ?? 'Unknown'); ?></td>
            <td><?php echo htmlspecialchars($r['device']); ?></td>
            <td><?php echo htmlspecialchars(substr($r['problem'],0,80)); ?></td>
            <td><?php echo htmlspecialchars($r['status']); ?></td>
            <td>
                <?php if($r['status'] !== 'resolved'): ?>
                    <a href="admin_dashboard.php?resolve_request=<?php echo (int)$r['id']; ?>">Mark Resolved</a>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<h3>Users</h3>
<table style="width:100%;border-collapse:collapse;margin-bottom:18px">
    <thead>
        <tr style="text-align:left;border-bottom:1px solid #eee">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
    <?php while($u = $userList->fetch_assoc()): ?>
        <tr>
            <td><?php echo (int)$u['id']; ?></td>
            <td><?php echo htmlspecialchars($u['full_name']); ?></td>
            <td><?php echo htmlspecialchars($u['email']); ?></td>
            <td><?php echo htmlspecialchars($u['role']); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</div>

</body>
</html>