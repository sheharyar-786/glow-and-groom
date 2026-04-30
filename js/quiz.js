function nextStep(step) {
    // Hide all steps
    document.querySelectorAll('.quiz-step').forEach(el => el.classList.remove('active'));
    
    // Show current step
    document.getElementById('step' + step).classList.add('active');
    
    // Update Progress Bar
    let progress = (step / 3) * 100;
    document.getElementById('progress').style.width = progress + '%';

    // If it's the loading step, simulate a delay then redirect
    if(step === 3) {
        setTimeout(() => {
            alert("Analysis complete! Redirecting to your custom bundle...");
            // In the future, this will link to your PHP results page
        }, 2000);
    }
}