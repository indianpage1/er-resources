<footer class="custom-footer">
    <div class="container">
        <div class="row text-center text-md-start">
            <!-- About -->
            <!-- Add this in your main layout file, like layouts/app.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

            <div class="col-md-4 mb-4">
                <h5>About ST-Earning</h5>
                <p>Your trusted platform for secure and profitable investments. We help individuals and businesses grow their wealth through expert earning plans.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('plans') }}">Plans</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <ul class="footer-links">
                    <li><a href="mailto:support@st-earning.com">support@st-earning.com</a></li>
                    <li><a href="tel:+1234567890">+123 456 7890</a></li>
                    <li><a href="https://goo.gl/maps/xyz">123 Earning St, Islamabad</a></li>
                </ul>
            </div>
        </div>

<!-- Social & Newsletter -->
<div class="row justify-content-center align-items-center text-center mt-4">
    <div class="col-lg-8">
        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mb-3">
            <a href="https://facebook.com"><i class="fab fa-facebook-f fa-lg"></i></a>
            <a href="https://twitter.com"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="https://linkedin.com"><i class="fab fa-linkedin-in fa-lg"></i></a>
            <a href="https://instagram.com"><i class="fab fa-instagram fa-lg"></i></a>
        </div>

        <form class="newsletter-form d-flex flex-wrap justify-content-center gap-2 mt-2" method="GET" action="{{ route('plans') }}">
            <input type="text" name="query" placeholder="Search plans..." required>
            <button type="submit"><i class="fas fa-search me-1"></i> Search</button>
        </form>
    </div>
</div>

        <!-- Footer Bottom -->
        <div class="footer-bottom mt-4 text-center">
            <p>&copy; {{ date('Y') }} ST-Earning. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
/* Footer Reset */
.custom-footer {
    background: #1e1e2f;
    color: #fff;
    padding: 50px 0 30px;
    position: relative;
    bottom: 0;
    width: 100%;
    flex-shrink: 0;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    color: #ccc;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #ffc107;
}

.custom-footer h5 {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.social-icons a {
    color: #fff;
    margin: 0 10px;
    font-size: 1.3rem;
    transition: 0.3s;
}

.social-icons a:hover {
    color: #ffc107;
}

.newsletter-form {
    max-width: 400px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.newsletter-form input[type="email"] {
    padding: 10px;
    width: 100%;
    max-width: 250px;
    border: none;
    border-radius: 5px;
}

.newsletter-form button {
    padding: 10px 20px;
    background-color: #ffc107;
    border: none;
    color: #000;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.newsletter-form button:hover {
    background-color: #e0a800;
}

/* Footer Bottom */
.footer-bottom p {
    margin-top: 20px;
    font-size: 0.9rem;
    color: #aaa;
}

/* Responsive */
@media (max-width: 768px) {
    .newsletter-form {
        flex-direction: column;
        align-items: center;
    }

    .newsletter-form input {
        max-width: 100%;
    }

    .newsletter-form button {
        width: 100%;
    }
}
</style>
