<?php 
$pageTitle = "Shipping & Returns | Glow & Groom";
$extraStyles = '<link rel="stylesheet" href="css/about.css"><style>
    .legal-card { background: white; padding: 50px; border-radius: 30px; box-shadow: 0 40px 100px rgba(26, 42, 42, 0.05); border: 1px solid #f9f9f9; margin-bottom: 50px; }
    .legal-card h3 { font-family: "Playfair Display", serif; font-size: 32px; margin-bottom: 25px; color: var(--primary); }
    .legal-card p { color: #777; font-size: 16px; line-height: 1.8; margin-bottom: 20px; }
    .legal-list { list-style: none; padding: 0; }
    .legal-list li { padding: 15px 0; border-bottom: 1px solid #f5f5f5; color: #555; display: flex; align-items: center; gap: 15px; }
    .legal-list li::before { content: "✓"; color: var(--accent); font-weight: 900; }
</style>';
include 'includes/header.php'; 
?>

<section class="about-hero" style="background-image: url('https://images.unsplash.com/photo-1566933293069-b55c7f326dd4?auto=format&fit=crop&q=80&w=1600');">
    <div class="container" data-aos="zoom-out">
        <span class="hero-subtitle">Concierge Services</span>
        <h1>Shipping & <br><span>Returns</span></h1>
    </div>
</section>

<main class="container" style="padding: 100px 0; max-width: 900px;">
    <div class="legal-card" data-aos="fade-up">
        <h3>Logistics & Delivery</h3>
        <p>We pride ourselves on swift, secure delivery. Every package is hand-inspected at our Sadiqabad studio before being dispatched to your doorstep.</p>
        <ul class="legal-list">
            <li><strong>Nationwide Coverage:</strong> We deliver to every city in Pakistan.</li>
            <li><strong>Flat Rate:</strong> 250 PKR shipping on all orders.</li>
            <li><strong>Rapid Processing:</strong> Orders confirmed before 2PM are shipped same-day.</li>
            <li><strong>Fulfillment Time:</strong> Expect your ritual to arrive in 3-5 business days.</li>
        </ul>
    </div>

    <div class="legal-card" data-aos="fade-up">
        <h3>The Returns Ritual</h3>
        <p>To maintain the highest standards of hygiene and safety, we only accept returns on products that are in their original, unopened state.</p>
        <ul class="legal-list">
            <li>Returns accepted within 7 days of delivery.</li>
            <li>Seals must be intact and packaging undamaged.</li>
            <li>Complimentary exchanges for items damaged during transit.</li>
        </ul>
    </div>

    <div class="contact-support text-center" style="margin-top: 80px;" data-aos="fade-up">
        <p style="color: #999; text-transform: uppercase; letter-spacing: 2px; font-size: 11px; margin-bottom: 10px;">Further Assistance</p>
        <h4 style="font-family: 'Playfair Display', serif; font-size: 24px;">Need immediate help?</h4>
        <a href="contact.php" class="btn-text" style="margin-top: 20px; display: inline-block;">Speak to a Consultant →</a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
