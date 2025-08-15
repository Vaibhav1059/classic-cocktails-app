<?php
// Include your main configuration file (it starts the session)
require_once 'Config/config.php';

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit; // Stop the script from running further
}
?>

<?php include('include/header.php'); ?>

<section class="hero-reservation mt-5">  

    <div class="container text-center">
        <h1 class="display-4 fw-bold">Reserve Your Table</h1>
        <p class="lead col-lg-8 mx-auto">Experience an unforgettable evening of exquisite food and timeless cocktails. Book your spot now to avoid disappointment.</p>
    </div>
</section>

<section class="py-5" >
    <div class="container">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-success">Your reservation has been successfully submitted! We look forward to seeing you.</div>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger">There was an error submitting your reservation. Please try again.</div>
        <?php endif; ?>
        
        <div class="booking-section">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">Reservation Details</h2>
                    <form method="POST" action="controller/controller.php" enctype="multipart/form-data">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_fullname']); ?>" readonly>
                                    <label for="name">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact Number" required>
                                    <label for="contact">Contact Number</label>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" id="guests" name="guests" class="form-control" placeholder="Number of Guests" required min="1">
                                    <label for="guests">Number of Guests</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" id="date" name="date" class="form-control" required>
                                    <label for="date">Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="time" id="time" name="time" class="form-control" required>
                                    <label for="time">Time</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mt-3">
                            <textarea id="message" name="message" class="form-control" placeholder="Any Special Request!" style="height: 100px"></textarea>
                            <label for="message">Special Requests (optional)</label>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning btn-lg px-5" name="submit_reservation">Confirm Reservation</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="ambiance-slider">
                        <div id="ambianceCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $images = ['r1.jpg', 'r2.jpg', 'r3.jpg', 'r4.jpg', 'r5.jpg'];
                                foreach ($images as $index => $image): ?>
                                    <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                    <img src="Public/Images/<?= $image; ?>" alt="Ambiance" class="ambiance-img d-block w-100">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#ambianceCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#ambianceCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('include/footer.php'); ?>