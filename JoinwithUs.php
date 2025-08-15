<?php include('include/header.php'); ?>

<div class="container">
    <!-- Page Heading -->
    <h1 class="text-danger my-3 mt-3 text-center text-capitalize">Join With Us</h1>
    
    <!-- Form Section -->
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form method="POST" action="controller/controller.php" enctype="multipart/form-data">
                <div class="form-group mb-3 mt-5">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" placeholder="Enter Your Full Name" class="form-control" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email:</label>
                    <input type="email" id="email" placeholder="Enter Your Email" class="form-control" name="email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="contact">Contact Number:</label>
                    <input type="number" id="contact" placeholder="Enter Your Contact Number" class="form-control" name="contact" required>
                </div>
                <div class="form-group mb-3">
                    <label for="message">Message:</label>
                    <textarea id="message" placeholder="Enter Your Query" class="form-control" name="message" rows="3" required></textarea>
                </div>
                <div class="form-group mb-3 mt-5">
                    <button type="submit" class="btn btn-success btn-md w-100" name="submit_join">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Display Success and Error Messages -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center my-3">
            <?= htmlspecialchars($_SESSION['error']) ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success text-center my-3">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
</div>

<!-- Location Section -->
<div class="row my-5">
    <div class="w-auto mx-auto p-5 bg-light">
        <h3 class="text-danger text-center text-capitalize">Our Location</h3>
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7121.158468630438!2d75.86657919999999!3d26.821523199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db770070b115f%3A0x6f306afd08a3e737!2sSwami%20Keshvanand%20Institute%20of%20Technology%2C%20Management%20%26%20Gramothan%20(SKIT)!5e0!3m2!1sen!2sin!4v1722337054693!5m2!1sen!2sin" 
            style="border:0; width: 100%; height: 400px;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<?php include('include/footer.php'); ?>
