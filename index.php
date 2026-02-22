<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>EddyMarsan Enterprise</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<nav>
    <span class="brand">EddyMarsan</span>
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="repair_request.php">Repair Service</a>
    <a href="cart.php">Cart</a>
    <?php if(isset($_SESSION['user'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</nav>

<main>
    <section class="hero">
        <div class="hero-card">
            <h1>Your reliable electronics store & repair shop</h1>
            <p>High quality devices, genuine parts and fast, professional repair services for laptops, desktops and printers.</p>
            <div style="display:flex;gap:12px;margin-top:18px;">
                <button class="btn btn-primary" onclick="location.href='products.php'">Shop Now <i class="fas fa-shopping-bag"></i></button>
                <?php if(isset($_SESSION['user'])): ?>
                    <button class="btn btn-ghost" onclick="location.href='dashboard.php'">Dashboard <i class="fas fa-user-circle"></i></button>
                <?php else: ?>
                    <button class="btn btn-ghost" onclick="location.href='login.php'">Login <i class="fas fa-sign-in-alt"></i></button>
                <?php endif; ?>
            </div>
        </div>
        <div class="hero-aside" aria-hidden="true"></div>
    </section>

    <section class="features">
        <div class="feature">
            <i class="fas fa-box-open" style="font-size:28px;color:#007bff;"></i>
            <h4>Wide Product Range</h4>
            <p>From peripherals to full systems — quality items at great prices.</p>
        </div>
        <div class="feature">
            <i class="fas fa-tools" style="font-size:28px;color:#007bff;"></i>
            <h4>Professional Repairs</h4>
            <p>Experienced technicians, fast turnaround and transparent pricing.</p>
        </div>
        <div class="feature">
            <i class="fas fa-headset" style="font-size:28px;color:#007bff;"></i>
            <h4>Customer Support</h4>
            <p>We're here to help — contact us for enquiries or aftercare.</p>
        </div>
    </section>

    <div class="site-footer">
        <p>&copy; <?php echo date('Y'); ?> EddyMarsan Enterprise — All rights reserved.</p>
    </div>
</main>

</body>
</html>