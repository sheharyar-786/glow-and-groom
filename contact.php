<?php 
$pageTitle = "Contact Us | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/contact.css">';
include 'includes/header.php'; 
?>

    <main class="contact-page">
        <div class="container">
            <section class="contact-intro" data-aos="fade-up">
                <span class="subtitle">Personal Assistance</span>
                <h1>How Can We Help?</h1>
                <p>Our experts are dedicated to helping you achieve your skincare goals.</p>
            </section>

            <div class="contact-grid">
                <div class="contact-form-wrapper" data-aos="fade-right">
                    <form action="#" class="pro-form">
                        <div class="form-row">
                            <div class="input-group">
                                <label>Full Name</label>
                                <input type="text" placeholder="e.g. Sheharyar" required>
                            </div>
                            <div class="input-group">
                                <label>Email Address</label>
                                <input type="email" placeholder="email@example.com" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label>Subject</label>
                            <select>
                                <option>Order Inquiry</option>
                                <option>Routine Advice</option>
                                <option>Wholesale Partnerships</option>
                                <option>Media & Press</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Your Message</label>
                            <textarea rows="5" placeholder="Share your concerns with us..."></textarea>
                        </div>
                        <button type="submit" class="send-btn">Send Inquiry</button>
                    </form>
                </div>

                <aside class="contact-info" data-aos="fade-left">
                    <div class="info-card info-gold">
                        <div class="info-icon">📍</div>
                        <div class="info-text">
                            <h4>Studio Address</h4>
                            <p>123 Beauty Lane, Sadiqabad, Punjab, Pakistan</p>
                        </div>
                    </div>
                    <div class="info-card info-blue">
                        <div class="info-icon">✉️</div>
                        <div class="info-text">
                            <h4>Direct Email</h4>
                            <p>hello@glowandgroom.com<br>support@glowandgroom.com</p>
                        </div>
                    </div>
                    <div class="info-card info-green">
                        <div class="info-icon">📞</div>
                        <div class="info-text">
                            <h4>Concierge Line</h4>
                            <p>+92 300 1234567<br>Mon - Fri, 9am - 6pm</p>
                        </div>
                    </div>
                </aside>
            </div>

            <section class="faq-section" data-aos="fade-up">
                <div class="section-header text-center">
                    <span class="subtitle">Quick Support</span>
                    <h2>Common Questions</h2>
                </div>
                <div class="faq-grid">
                    <div class="faq-card">
                        <h5>Nationwide Delivery?</h5>
                        <p>Yes, we ship premium care to every city in Pakistan. Expected arrival is 3-5 business days from dispatch.</p>
                    </div>
                    <div class="faq-card">
                        <h5>Return Policy?</h5>
                        <p>Due to hygiene safety, we only accept returns on unopened, sealed products within 7 days of delivery.</p>
                    </div>
                    <div class="faq-card">
                        <h5>Routine Advice?</h5>
                        <p>Use our Routine Builder for an instant plan, or message us for personalized professional advice.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

<?php include 'includes/footer.php'; ?>