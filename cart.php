<?php
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
?>
<?php
$result = $conn->query("
SELECT products.*, cart.quantity 
FROM cart 
JOIN products ON cart.product_id = products.id
WHERE cart.user_id = '$user_id'
");

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
<a href="products.php">Continue Shopping</a>
</nav>

<div class="container">
<h2>My Cart</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): 
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
    ?>
    <div class="cart-item">
        <p><?php echo htmlspecialchars($row['product_name']); ?></p>
        <p>Price: ₦<?php echo htmlspecialchars($row['price']); ?></p>
        <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
        <p>Subtotal: ₦<?php echo htmlspecialchars($subtotal); ?></p>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<h3>Total: ₦<?php echo $total; ?></h3>
<?php if ($total > 0): ?>
    <button onclick="checkout()">Checkout</button>
<?php endif; ?>
</div>

<script>
function checkout(){
    alert("Checkout system coming next!");
}
</script>

</body>
</html>