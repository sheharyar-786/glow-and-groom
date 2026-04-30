<?php 
$pageTitle = "Privacy Policy | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/about.css"><style>
    .privacy-card { background: white; padding: 50px; border-radius: 30px; box-shadow: 0 40px 100px rgba(26, 42, 42, 0.05); border: 1px solid #f9f9f9; margin-bottom: 40px; }
    .privacy-card h3 { font-family: "Playfair Display", serif; font-size: 28px; margin-bottom: 20px; color: var(--primary); display: flex; align-items: center; gap: 15px; }
    .privacy-card h3 span { color: var(--accent); font-size: 18px; font-weight: 700; font-family: "Montserrat", sans-serif; }
    .privacy-card p { color: #666; line-height: 1.8; font-size: 16px; }
</style>';
include 'includes/header.php'; 
?>

<section class="about-hero" style="background-image: url('https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=1600');">
    <div class="container" data-aos="zoom-out">
        <span class="hero-subtitle">Trust & Transparency</span>
        <h1>Privacy <br><span>Protocol</span></h1>
    </div>
</section>

<main class="container" style="padding: 100px 0; max-width: 900px;">
    <div class="privacy-intro text-center" style="margin-bottom: 80px;" data-aos="fade-up">
        <p style="font-size: 20px; color: #444; font-family: 'Playfair Display', serif; line-height: 1.6;">"Your trust is our most valuable asset. We are committed to protecting your personal data with the same care we use to craft our products."</p>
    </div>

    <div class="privacy-card" data-aos="fade-up">
        <h3><span>01.</span> Data Acquisition</h3>
        <p>We collect essential information—such as your name, contact details, and skin profile—only to enhance your shopping experience and provide precise routine recommendations.</p>
    </div>

    <div class="privacy-card" data-aos="fade-up">
        <h3><span>02.</span> Use of Information</h3>
        <p>Your information is used solely for order fulfillment, personalized service, and (with your permission) exclusive brand updates. We never sell your data to third parties.</p>
    </div>

    <div class="privacy-card" data-aos="fade-up">
        <h3><span>03.</span> Secure Encryption</h3>
        <p>All transactions are shielded by industry-leading SSL encryption, ensuring your financial and personal details remain confidential and secure at all times.</p>
    </div>

    <div class="privacy-card" data-aos="fade-up">
        <h3><span>04.</span> Your Rights</h3>
        <p>You have the absolute right to access, update, or request the deletion of your personal data at any time through your account settings or by contacting our team.</p>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
