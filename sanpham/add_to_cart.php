<?php
session_start();

// Check if the product ID is provided
if (isset($_POST['product_id']) && isset($_POST['quantity'])&& isset($_POST['price'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $price=$_POST['price'];
    

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update the quantity
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // Add the product to the cart
        $_SESSION['cart'][$product_id] = $quantity;
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Product added to cart successfully!',
        'cart' => $_SESSION['cart']
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid product data!'
    ]);
}
?>