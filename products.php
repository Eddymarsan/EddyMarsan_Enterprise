<?php
include "config.php";

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$q_esc = $conn->real_escape_string($q);
$sql = "SELECT * FROM products";
if ($q !== '') {
    $sql .= " WHERE product_name LIKE '%$q_esc%' OR description LIKE '%$q_esc%'";
}
$sql .= " ORDER BY id DESC";
$result = $conn->query($sql);

$products = [];
while ($r = $result->fetch_assoc()) {
    $products[] = $r;
}

// collect categories if present
$categories = [];
foreach ($products as $p) {
    if (isset($p['category']) && $p['category'] !== '') {
        $categories[$p['category']] = true;
    }
}

$selectedCat = isset($_GET['cat']) ? $_GET['cat'] : '';
?>

<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>
</nav>

<main class="container">
    <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;justify-content:space-between">
        <h2 style="margin:0">Products</h2>
        <form method="GET" style="display:flex;gap:8px;align-items:center">
            <input type="search" name="q" placeholder="Search products..." value="<?php echo htmlspecialchars($q); ?>" style="padding:8px;border-radius:8px;border:1px solid #ddd">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
    </div>

    <?php if (!empty($categories)): ?>
        <div style="margin-top:14px;display:flex;gap:8px;flex-wrap:wrap">
            <a href="products.php" class="btn btn-ghost" style="padding:6px 10px">All</a>
            <?php foreach($categories as $cat => $_): ?>
                <a href="products.php?cat=<?php echo urlencode($cat); ?>" class="btn btn-ghost" style="padding:6px 10px;<?php echo $selectedCat===$cat? 'box-shadow:inset 0 -3px 0 #007bff' : ''?>"><?php echo htmlspecialchars($cat); ?></a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="product-grid" style="margin-top:18px">

    <?php foreach($products as $row): 
        if ($selectedCat && (!isset($row['category']) || $row['category'] !== $selectedCat)) continue;
        $img = !empty($row['image']) ? 'uploads/'.htmlspecialchars($row['image']) : 'https://via.placeholder.com/300x200?text=No+Image';
        $inStock = isset($row['stock']) ? (int)$row['stock'] : 1;
    ?>
        <div class="product-card">
            <div style="height:150px;display:flex;align-items:center;justify-content:center;overflow:hidden">
                <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" style="max-width:100%;height:auto;">
            </div>
            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
            <p style="color:#64748b;font-size:0.95rem;height:48px;overflow:hidden"><?php echo htmlspecialchars(substr($row['description'],0,140)); ?></p>
            <p class="price">₦<?php echo htmlspecialchars($row['price']); ?></p>
            <div style="display:flex;gap:8px;margin-top:8px;align-items:center">
                <?php if ($inStock > 0): ?>
                    <button onclick="location.href='add_to_cart.php?id=<?php echo (int)$row['id']; ?>'" class="btn btn-primary">Add to Cart</button>
                <?php else: ?>
                    <button disabled style="background:#ccc;color:#444;padding:8px 12px;border-radius:8px;border:none">Out of stock</button>
                <?php endif; ?>
                <a href="product_view.php?id=<?php echo (int)$row['id']; ?>" class="btn btn-ghost">Details</a>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (empty($products)): ?>
        <p>No products found.</p>
    <?php endif; ?>

    </div>

</main>

</body>
</html>