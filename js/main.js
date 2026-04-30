/**
 * Glow & Groom - Main Interactive Logic
 */

// 1. Gallery Image Switcher
function changeImg(src) {
    const mainImg = document.getElementById('current-img');
    const thumbnails = document.querySelectorAll('.thumb');
    
    // Add fade out effect
    mainImg.style.opacity = '0';
    
    setTimeout(() => {
        mainImg.src = src;
        mainImg.style.opacity = '1';
    }, 300);

    // Update active thumbnail
    thumbnails.forEach(thumb => {
        if (thumb.src === src) {
            thumb.classList.add('active');
        } else {
            thumb.classList.remove('active');
        }
    });
}

// 2. Quantity Selector
function updateQty(val) {
    const qtyInput = document.getElementById('qty');
    if (!qtyInput) return;
    
    let current = parseInt(qtyInput.value);
    if (current + val >= 1) {
        qtyInput.value = current + val;
    }
}

// 3. Professional Accordion Toggle
document.querySelectorAll('.accordion-header').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.parentElement;
        const content = button.nextElementSibling;
        const isOpen = item.classList.contains('active');

        // Close all other items (optional, for a cleaner look)
        document.querySelectorAll('.accordion-item').forEach(otherItem => {
            otherItem.classList.remove('active');
            otherItem.querySelector('.accordion-content').style.display = 'none';
        });

        // Toggle current item
        if (!isOpen) {
            item.classList.add('active');
            content.style.display = 'block';
        }
    });
});

// 4. Header & Scroll Effects
window.addEventListener('scroll', () => {
    const header = document.querySelector('.main-header');
    const scrollTopBtn = document.getElementById('scrollTop');
    
    // Toggle Button Visibility
    if (window.scrollY > 300) {
        scrollTopBtn.classList.add('visible');
    } else {
        scrollTopBtn.classList.remove('visible');
    }
});

// Scroll to Top Function
document.getElementById('scrollTop').addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// 5. Cart Animation Mock
document.querySelectorAll('.add-to-cart-btn, .quick-add').forEach(btn => {
    btn.addEventListener('click', () => {
        const cartCount = document.querySelector('.cart-count');
        let count = parseInt(cartCount.innerText);
        cartCount.innerText = count + 1;
        
        // Add a "pop" animation
        cartCount.style.transform = 'scale(1.5)';
        setTimeout(() => {
            cartCount.style.transform = 'scale(1)';
        }, 300);
    });
});