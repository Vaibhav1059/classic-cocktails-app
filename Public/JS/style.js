AOS.init({
  duration: 1000,
  once: true,
  offset: 80
});

window.addEventListener('DOMContentLoaded', function () {
  particlesJS("particles-js", {
    particles: {
      number: {
        value: 60,
        density: {
          enable: true,
          value_area: 800
        }
      },
      color: {
        value: "#ffffff"
      },
      shape: {
        type: "circle"
      },
      opacity: {
        value: 0.3,
        random: true
      },
      size: {
        value: 4,
        random: true
      },
      line_linked: {
        enable: true,
        distance: 150,
        color: "#ffffff",
        opacity: 0.2,
        width: 1
      },
      move: {
        enable: true,
        speed: 1.5,
        direction: "none",
        out_mode: "bounce"
      }
    },
    interactivity: {
      events: {
        onhover: {
          enable: true,
          mode: "repulse"
        },
        onclick: {
          enable: true,
          mode: "push"
        }
      },
      modes: {
        repulse: {
          distance: 100
        },
        push: {
          particles_nb: 4
        }
      }
    },
    retina_detect: true
  });
});

//toast home page
const toastEl = document.querySelector('.toast');
const toast = new bootstrap.Toast(toastEl);
toast.show();

setTimeout(() => {
  toast.hide();
}, 2000); // or use 1000 for 1 second

//Get to top scroll
document.querySelector('.footer-scroll-btn').addEventListener('click', function (e) {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// JavaScript to set the minimum date for the date picker to today
document.addEventListener('DOMContentLoaded', function () {
  const today = new Date().toISOString().split('T')[0];
  document.getElementById('date').setAttribute('min', today);
});
// contact form 
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('contactForm');
  const formStatus = document.getElementById('form-status');
  const submitBtn = document.getElementById('submitBtn');
  const spinner = submitBtn.querySelector('.spinner-border');
  const btnText = submitBtn.querySelector('.btn-text');

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    event.stopPropagation();

    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      return;
    }

    // Show loading state
    btnText.textContent = 'Sending...';
    spinner.style.display = 'inline-block';
    submitBtn.disabled = true;

    // Simulate a network request
    setTimeout(() => {
      // Reset button
      btnText.textContent = 'Submit';
      spinner.style.display = 'none';
      submitBtn.disabled = false;

      // Show success message
      formStatus.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Success!</strong> Your message has been sent. We'll get back to you shortly.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;

      // Reset form fields and validation
      form.reset();
      form.classList.remove('was-validated');

    }, 2000); // 2-second delay to simulate sending
  });
});

//login - register 
document.addEventListener('DOMContentLoaded', function () {
    // --- Password Visibility Toggle ---
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
    }

    // --- Registration Form Password Confirmation ---
    const registerForm = document.getElementById('register-form');

    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                // Stop form submission
                e.preventDefault();
                // Alert the user
                alert("Passwords do not match. Please try again.");
            }
        });
    }
});

// Share Option

document.addEventListener('DOMContentLoaded', function() {
    const shareButton = document.getElementById('shareButton');
    const shareModalElement = document.getElementById('shareModal');
    const shareModal = new bootstrap.Modal(shareModalElement);

    // Data to share
    const shareData = {
        title: document.title,
        text: 'Check out this amazing page from Classic Cocktails With A Twist!',
        url: window.location.href
    };

    // --- Main Share Button Logic ---
    shareButton.addEventListener('click', async () => {
        // Use Web Share API if available (modern approach)
        if (navigator.share) {
            try {
                await navigator.share(shareData);
                console.log('Page shared successfully');
            } catch (err) {
                console.log(`Share failed: ${err}`);
            }
        } else {
            // Fallback to showing the modal
            // Update modal links with the current page URL
            const encodedUrl = encodeURIComponent(window.location.href);
            document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
            document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?url=${encodedUrl}&text=${encodeURIComponent(shareData.text)}`;
            document.getElementById('shareWhatsApp').href = `https://api.whatsapp.com/send?text=${encodeURIComponent(shareData.text + ' ' + window.location.href)}`;
            document.getElementById('shareEmail').href = `mailto:?subject=${encodeURIComponent(shareData.title)}&body=${encodeURIComponent(shareData.text + ' ' + window.location.href)}`;
            document.getElementById('shareLinkInput').value = window.location.href;
            
            shareModal.show();
        }
    });

    // --- Copy Link Button Logic for Modal ---
    const copyLinkBtn = document.getElementById('copyLinkBtn');
    const shareLinkInput = document.getElementById('shareLinkInput');
    copyLinkBtn.addEventListener('click', () => {
        navigator.clipboard.writeText(shareLinkInput.value).then(() => {
            copyLinkBtn.textContent = 'Copied!';
            setTimeout(() => {
                copyLinkBtn.textContent = 'Copy';
            }, 2000);
        });
    });
});

