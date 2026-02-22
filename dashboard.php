<?php
include "config.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.dashboard-header {
    text-align: center;
    margin-bottom: 40px;
}
.dashboard-header i {
    font-size: 4em;
    color: #007bff;
    margin-bottom: 10px;
}
.welcome-message {
    font-size: 1.5em;
    color: #333;
}
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 30px;
}
.action-card {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}
.action-card:hover {
    transform: translateY(-5px);
}
.action-card i {
    font-size: 2em;
    color: #007bff;
    margin-bottom: 10px;
}
.action-card a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}
.stats-section {
    margin-top: 40px;
}
.stats-section h3 {
    text-align: center;
    margin-bottom: 20px;
}
</style>
</head>
<body>

<nav>
    <a href="products.php"><i class="fas fa-shopping-bag"></i> View Products</a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a>
    <a href="repair_request.php"><i class="fas fa-tools"></i> Repair Request</a>
    <?php if($_SESSION['user']['role'] == 'admin'): ?>
        <a href="add_product.php"><i class="fas fa-plus"></i> Add Product</a>
        <a href="admin_dashboard.php"><i class="fas fa-cog"></i> Admin Panel</a>
    <?php endif; ?>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</nav>

<div class="container">
<div class="dashboard-header">
    <i class="fas fa-tachometer-alt"></i>
    <h2>Dashboard</h2>
    <p class="welcome-message">Welcome back, <?php echo htmlspecialchars($_SESSION['user']['full_name']); ?>!</p>
</div>

<div class="quick-actions">
    <div class="action-card">
        <i class="fas fa-shopping-bag"></i>
        <a href="products.php">Browse Products</a>
        <p>Explore our latest products</p>
    </div>
    <div class="action-card">
        <i class="fas fa-shopping-cart"></i>
        <a href="cart.php">View Cart</a>
        <p>Check your shopping cart</p>
    </div>
    <div class="action-card">
        <i class="fas fa-tools"></i>
        <a href="repair_request.php">Repair Services</a>
        <p>Request computer repairs</p>
    </div>
    <?php if($_SESSION['user']['role'] == 'admin'): ?>
    <div class="action-card">
        <i class="fas fa-plus"></i>
        <a href="add_product.php">Add Product</a>
        <p>Manage your inventory</p>
    </div>
    <?php endif; ?>
</div>

<div class="stats-section">
    <h3>Your Activity</h3>
    <div class="stats">
        <div class="card">
            <h4>Orders</h4>
            <p>0</p> <!-- Placeholder, can be dynamic -->
        </div>
        <div class="card">
            <h4>Cart Items</h4>
            <p>0</p> <!-- Placeholder -->
        </div>
        <div class="card">
            <h4>Repair Requests</h4>
            <p>0</p> <!-- Placeholder -->
        </div>
    </div>
</div>
</div>

</body>
</html>