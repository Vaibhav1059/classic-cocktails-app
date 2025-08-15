<?php
// Include the main configuration file which starts the session
require_once '../Config/config.php';

// =================================================================
// == HANDLE 'RESERVATION' SUBMISSION ==
// =================================================================
if (isset($_POST['submit_reservation'])) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $contact = $_POST['contact'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    if (empty($contact) || empty($guests) || empty($date) || empty($time)) { header("Location: ../Reservation.php?error=emptyfields"); exit(); }
    $query = "INSERT INTO reservations (user_id, contact_number, num_guests, reservation_date, reservation_time, special_requests) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $contact, $guests, $date, $time, $message);
    if (mysqli_stmt_execute($stmt)) { header("Location: ../Reservation.php?status=success"); } 
    else { header("Location: ../Reservation.php?status=error"); }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit();
}

// =================================================================
// == HANDLE 'PLACE ORDER' FROM CHECKOUT PAGE ==
// =================================================================
if (isset($_POST['place_order'])) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $table_number = $_POST['table_number'];
    $special_instructions = $_POST['special_instructions'];
    $cart_json = $_POST['cart_data'];
    $cart_items = json_decode($cart_json, true);
    if (empty($cart_items) || !is_array($cart_items)) { header("Location: ../checkout.php?status=error_cart_empty"); exit(); }
    $subtotal = 0;
    foreach ($cart_items as $item) { $subtotal += $item['price'] * $item['quantity']; }
    $tax = $subtotal * 0.05;
    $grand_total = $subtotal + $tax;
    mysqli_begin_transaction($conn);
    try {
        $order_query = "INSERT INTO orders (user_id, table_number, special_instructions, grand_total) VALUES (?, ?, ?, ?)";
        $stmt_order = mysqli_prepare($conn, $order_query);
        mysqli_stmt_bind_param($stmt_order, "issd", $user_id, $table_number, $special_instructions, $grand_total);
        mysqli_stmt_execute($stmt_order);
        $order_id = mysqli_insert_id($conn);
        $item_query = "INSERT INTO order_items (order_id, product_name, quantity, price_per_item) VALUES (?, ?, ?, ?)";
        $stmt_item = mysqli_prepare($conn, $item_query);
        foreach ($cart_items as $item) {
            mysqli_stmt_bind_param($stmt_item, "isid", $order_id, $item['name'], $item['quantity'], $item['price']);
            mysqli_stmt_execute($stmt_item);
        }
        mysqli_commit($conn);
        header("Location: ../order_success.php");
        exit();
    } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($conn);
        header("Location: ../checkout.php?status=error_processing");
        exit();
    }
}

// =================================================================
// == HANDLE 'UPDATE PROFILE' FROM MY_PROFILE PAGE ==
// =================================================================
if (isset($_POST['update_profile'])) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET fullname = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $fullname, $hashed_password, $user_id);
    } else {
        $query = "UPDATE users SET fullname = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "si", $fullname, $user_id);
    }
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['user_fullname'] = $fullname;
        header("Location: ../my_profile.php?status=profile_updated");
    } else {
        header("Location: ../my_profile.php?status=error");
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    exit();
}

// =================================================================
// == HANDLE 'CANCEL RESERVATION' FROM MY_PROFILE PAGE ==
// =================================================================
if (isset($_GET['action']) && $_GET['action'] == 'cancel_reservation') {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $reservation_id = $_GET['id'];
    $query = "UPDATE reservations SET status = 'Cancelled' WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $reservation_id, $user_id);
    if (mysqli_stmt_execute($stmt)) { header("Location: ../my_profile.php?status=reservation_cancelled#reservations"); } 
    else { header("Location: ../my_profile.php?status=error#reservations"); }
    exit();
}

// =================================================================
// == HANDLE 'UPDATE RESERVATION' FROM MY_PROFILE PAGE ==
// =================================================================
if (isset($_POST['update_reservation'])) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $reservation_id = $_POST['reservation_id'];
    $guests = $_POST['guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $query = "UPDATE reservations SET num_guests = ?, reservation_date = ?, reservation_time = ? WHERE id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issii", $guests, $date, $time, $reservation_id, $user_id);
    if (mysqli_stmt_execute($stmt)) { header("Location: ../my_profile.php?status=reservation_updated#reservations"); } 
    else { header("Location: ../my_profile.php?status=error#reservations"); }
    exit();
}

// =================================================================
// == HANDLE 'CANCEL ORDER' FROM MY_PROFILE PAGE ==
// =================================================================
if (isset($_GET['action']) && $_GET['action'] == 'cancel_order') {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { header("location: ../login.php"); exit; }
    $conn = dbConnect('main');
    $user_id = $_SESSION['user_id'];
    $order_id = $_GET['id'];
    $query = "UPDATE orders SET status = 'Cancelled' WHERE id = ? AND user_id = ? AND status = 'Received'";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ii", $order_id, $user_id);
    if (mysqli_stmt_execute($stmt)) { header("Location: ../my_profile.php?status=order_cancelled"); } 
    else { header("Location: ../my_profile.php?status=error"); }
    exit();
}