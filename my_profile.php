<?php
// Include your main configuration file
require_once 'Config/config.php';

// --- SECURITY CHECK ---
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// --- DATABASE FETCHING ---
$conn = dbConnect('main');
$user_id = $_SESSION['user_id'];

// 1. FETCH USER'S RESERVATIONS
$reservations = [];
$res_query = "SELECT id, reservation_date, reservation_time, num_guests, status FROM reservations WHERE user_id = ? ORDER BY reservation_date DESC";
$stmt_res = mysqli_prepare($conn, $res_query);
mysqli_stmt_bind_param($stmt_res, "i", $user_id);
mysqli_stmt_execute($stmt_res);
$result_res = mysqli_stmt_get_result($stmt_res);
while ($row = mysqli_fetch_assoc($result_res)) {
    $reservations[] = $row;
}
mysqli_stmt_close($stmt_res);

// 2. FETCH USER'S ORDERS AND THEIR ITEMS
$orders = [];
$order_query = "SELECT id, order_date, grand_total, status FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt_ord = mysqli_prepare($conn, $order_query);
mysqli_stmt_bind_param($stmt_ord, "i", $user_id);
mysqli_stmt_execute($stmt_ord);
$result_ord = mysqli_stmt_get_result($stmt_ord);
while ($order_row = mysqli_fetch_assoc($result_ord)) {
    // For each order, fetch its items
    $order_items = [];
    $order_id = $order_row['id'];
    $item_query = "SELECT product_name, quantity, price_per_item FROM order_items WHERE order_id = ?";
    $stmt_item = mysqli_prepare($conn, $item_query);
    mysqli_stmt_bind_param($stmt_item, "i", $order_id);
    mysqli_stmt_execute($stmt_item);
    $result_item = mysqli_stmt_get_result($stmt_item);
    while ($item_row = mysqli_fetch_assoc($result_item)) {
        $order_items[] = $item_row;
    }
    mysqli_stmt_close($stmt_item);
    $order_row['items'] = $order_items;
    $orders[] = $order_row;
}
mysqli_stmt_close($stmt_ord);
mysqli_close($conn);
?>
<?php include('include/header.php'); ?>

<div class="container my-5">
    <?php if(isset($_GET['status'])): ?>
        <div class="alert alert-<?php 
            switch($_GET['status']) {
                case 'profile_updated':
                case 'reservation_updated':
                    echo 'success'; break;
                case 'reservation_cancelled':
                case 'order_cancelled':
                    echo 'info'; break;
                default:
                    echo 'danger';
            }
        ?> alert-dismissible fade show">
            <?php 
                switch($_GET['status']) {
                    case 'profile_updated': echo 'Your profile has been updated successfully.'; break;
                    case 'reservation_updated': echo 'Your reservation has been updated successfully.'; break;
                    case 'reservation_cancelled': echo 'The reservation has been cancelled.'; break;
                    case 'order_cancelled': echo 'The order has been cancelled.'; break;
                    default: echo 'An error occurred. Please try again.';
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
            <div class="card text-bg-dark border-secondary">
                <div class="card-body text-center">
                    <img src="https://placehold.co/150x150/D4AF37/000000?text=<?php echo strtoupper(substr($_SESSION['user_fullname'], 0, 1)); ?>" class="rounded-circle mb-3" alt="Profile Picture">
                    <h4 class="card-title"><?php echo htmlspecialchars($_SESSION['user_fullname']); ?></h4>
                    <p class="text-muted mb-0"><?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-warning w-100" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card text-bg-dark border-secondary">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myProfileTabs" role="tablist">
                        <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#orders-tab-pane">My Orders</button></li>
                        <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reservations-tab-pane">My Reservations</button></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myProfileTabsContent">
                        <div class="tab-pane fade show active" id="orders-tab-pane">
                            <?php if (empty($orders)): ?>
                                <p class="text-center p-4">You have not placed any orders yet.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover align-middle">
                                        <thead><tr><th>Order ID</th><th>Date</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
                                        <tbody>
                                            <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td>#<?php echo $order['id']; ?></td>
                                                <td><?php echo date("d M, Y", strtotime($order['order_date'])); ?></td>
                                                <td>₹<?php echo number_format($order['grand_total'], 2); ?></td>
                                                <td><span class="badge bg-<?php echo ($order['status']=='Cancelled' ? 'danger':'success'); ?>"><?php echo $order['status']; ?></span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-warning view-order-details" data-order-id="<?php echo $order['id']; ?>">Details</button>
                                                    <?php if ($order['status'] == 'Received'): ?>
                                                        <a href="controller/controller.php?action=cancel_order&id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Are you sure?');">Cancel</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="tab-pane fade" id="reservations-tab-pane">
                             <?php if (empty($reservations)): ?>
                                <p class="text-center p-4">You have no upcoming reservations.</p>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover align-middle">
                                        <thead><tr><th>Date</th><th>Time</th><th>Guests</th><th>Status</th><th>Actions</th></tr></thead>
                                        <tbody>
                                            <?php foreach ($reservations as $res): ?>
                                            <tr>
                                                <td><?php echo date("d M, Y", strtotime($res['reservation_date'])); ?></td>
                                                <td><?php echo date("g:i A", strtotime($res['reservation_time'])); ?></td>
                                                <td><?php echo $res['num_guests']; ?></td>
                                                <td><span class="badge bg-<?php echo $res['status'] == 'Cancelled' ? 'danger' : 'secondary'; ?>"><?php echo $res['status']; ?></span></td>
                                                <td>
                                                    <?php if ($res['status'] != 'Cancelled'): ?>
                                                    <button class="btn btn-sm btn-outline-info edit-reservation" data-id="<?php echo $res['id']; ?>">Edit</button>
                                                    <a href="controller/controller.php?action=cancel_reservation&id=<?php echo $res['id']; ?>" class="btn btn-sm btn-outline-danger ms-1" onclick="return confirm('Are you sure?');">Cancel</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content text-bg-dark border-secondary">
            <div class="modal-header"><h5 class="modal-title">Edit Your Profile</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <form method="post" action="controller/controller.php">
                <div class="modal-body">
                    <div class="mb-3"><label for="editName" class="form-label">Full Name</label><input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($_SESSION['user_fullname']); ?>"></div>
                    <div class="mb-3"><label class="form-label">Email Address</label><input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" disabled></div>
                    <div class="mb-3"><label class="form-label">New Password</label><input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="orderDetailsModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-secondary">
      <div class="modal-header"><h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <div class="modal-body" id="orderDetailsModalBody"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="editReservationModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content text-bg-dark border-secondary">
      <div class="modal-header"><h5 class="modal-title">Edit Reservation</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
      <form method="post" action="controller/controller.php">
          <div class="modal-body">
              <input type="hidden" name="reservation_id" id="editReservationId">
              <div class="mb-3"><label for="editGuests" class="form-label">Number of Guests</label><input type="number" class="form-control" id="editGuests" name="guests" required min="1"></div>
              <div class="row">
                  <div class="col-6"><label for="editDate" class="form-label">Date</label><input type="date" class="form-control" id="editDate" name="date" required></div>
                  <div class="col-6"><label for="editTime" class="form-label">Time</label><input type="time" class="form-control" id="editTime" name="time" required></div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update_reservation" class="btn btn-primary">Save Changes</button>
          </div>
      </form>
    </div>
  </div>
</div>

<?php include('include/footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Pass PHP data to JavaScript
const ordersData = <?php echo json_encode($orders); ?>;
const reservationsData = <?php echo json_encode($reservations); ?>;

// Modal instances
const orderDetailsModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
const editReservationModal = new bootstrap.Modal(document.getElementById('editReservationModal'));

document.body.addEventListener('click', function(e) {
    const viewOrderBtn = e.target.closest('.view-order-details');
    if (viewOrderBtn) {
        const orderId = parseInt(viewOrderBtn.dataset.orderId, 10);
        const order = ordersData.find(o => o.id === orderId);
        if (order) {
            document.getElementById('orderDetailsModalLabel').textContent = `Order #${order.id} Details`;
            let content = '<ul class="list-group list-group-flush">';
            order.items.forEach(item => {
                content += `<li class="list-group-item d-flex justify-content-between align-items-center bg-transparent text-light border-secondary"><div><h6 class="mb-0">${item.product_name}</h6><small>${item.quantity} x ₹${parseFloat(item.price_per_item).toFixed(2)}</small></div><span class="fw-bold">₹${(item.quantity * item.price_per_item).toFixed(2)}</span></li>`;
            });
            content += `</ul><div class="d-flex justify-content-between fw-bold text-warning fs-5 mt-3 pt-3 border-top border-secondary"><span>Grand Total</span><span>₹${parseFloat(order.grand_total).toFixed(2)}</span></div>`;
            document.getElementById('orderDetailsModalBody').innerHTML = content;
            orderDetailsModal.show();
        }
    }

    const editReservationBtn = e.target.closest('.edit-reservation');
    if (editReservationBtn) {
        const reservationId = parseInt(editReservationBtn.dataset.id, 10);
        const reservation = reservationsData.find(r => r.id === reservationId);
        if (reservation) {
            document.getElementById('editReservationId').value = reservation.id;
            document.getElementById('editGuests').value = reservation.num_guests;
            document.getElementById('editDate').value = reservation.reservation_date;
            document.getElementById('editTime').value = reservation.reservation_time;
            editReservationModal.show();
        }
    }
});
</script>