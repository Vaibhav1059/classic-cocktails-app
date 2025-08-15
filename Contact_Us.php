<?php
    // Include your main config file
    require_once 'Config/config.php';
    $form_message = '';
    $form_message_type = '';

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Connect to the main database
    $conn = dbConnect('main');

    // Get data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Basic validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $form_message = "All fields are required.";
        $form_message_type = "danger";
    } else {
        // Use a prepared statement to prevent SQL Injection
        $query = "INSERT INTO contact_messages (fullname, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        // Bind parameters: s = string
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $form_message = "Thank you! Your message has been sent successfully.";
            $form_message_type = "success";
        } else {
            $form_message = "Sorry, something went wrong. Please try again later.";
            $form_message_type = "danger";
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
 }
?>

<?php include('include/header.php'); ?>
 
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold" style="font-family: 'Playfair Display', serif; color: #D4AF37;">Get In Touch</h1>
        <p class="lead text-white-50">We welcome your questions, feedback, and inquiries. Reach out to us.</p>
    </div>

    <div class="contact-container">
        <div class="row g-0">
            <div class="col-lg-5 contact-info-section">
                <h2 class="mb-4">Contact Information</h2>
                <p>Find us at our prime location, or drop us a line. We're always happy to connect with our patrons.</p>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <div class="info-text">
                        <h5>Our Location</h5>
                        <p>123 Cocktail Avenue, The Lounge District, Jaipur, Rajasthan 302001</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope icon"></i>
                    <div class="info-text">
                        <h5>Email Us</h5>
                        <p>hello@classiccocktailscafe.com</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone icon"></i>
                    <div class="info-text">
                        <h5>Call for Reservations</h5>
                        <p>+91 (555) 987-6543</p>
                    </div>
                </div>
                
                <iframe class="map-iframe mt-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.736932596593!2d75.7729223150361!3d26.91243598312297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db413526f296d%3A0x8f72381273945396!2sJaipur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1628507851602!5m2!1sen!2sin" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col-lg-7 contact-form-section">
                <h2 class="mb-4">Send Us a Message</h2>

                <?php if ($form_message): ?>
                <div id="form-status" class="alert alert-<?php echo $form_message_type; ?> mb-3">
                    <?php echo $form_message; ?>
                </div>
                <?php endif; ?>

                <form id="contactForm" method="post" action="contact_Us.php">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-12">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Your Message or Query</label>
                            <textarea class="form-control" id="message" name="message" rows="8" required></textarea>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>