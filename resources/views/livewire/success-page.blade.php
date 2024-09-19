{{-- <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card text-center p-5" style="background: linear-gradient(135deg, #67b26f, #4ca2cd); color: white; border-radius: 20px;">
        <div class="card-body">
            <!-- Success Icon -->
            <i class="fas fa-check-circle mb-4" style="font-size: 4rem;"></i>

            <!-- Success Title -->
            <h1 class="display-4 fw-bold">Success!</h1>

            <!-- Success Message -->
            <p class="lead mt-3">Your request has been successfully sent. We'll get back to you shortly!</p>

            <!-- Back to Home Button -->
            <a href="/" class="btn btn-lg btn-light mt-4" style="border-radius: 50px;">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
    </div>
</div>

@script

<script>
    // Auto-redirect after 5 seconds
    setTimeout(function() {
        window.location.href = '/';
    }, 5000);
</script>

@endscript --}}
<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card text-center p-5" >
        <div class="card-body">
            <!-- Success Icon -->
            <i class="fas fa-check-circle mb-4" style="font-size: 4rem;"></i>

            <!-- Success Title -->
            <h1 class="display-4 fw-bold">تم إرسال الطلب بنجاح!</h1>

            <!-- Success Message -->
            <p class="lead mt-3">تم إرسال طلبك بنجاح. سنقوم بالرد عليك قريبًا.</p>

            <!-- Back to Home Button -->
            <a href="/" class="btn btn-lg btn-light mt-4" style="border-radius: 50px;">
                <i class="fas fa-home"></i> العودة إلى الصفحة الرئيسية
            </a>

            <!-- Message for Auto-Redirect -->
            <p class="mt-3">سيتم تحويلك تلقائيًا خلال <span id="countdown">5</span> ثوانٍ.</p>
        </div>
    </div>
</div>
@script

<script>
    // Auto-redirect after 5 seconds
    setTimeout(function() {
        window.location.href = '/';
    }, 5000);
</script>
<script>
    // Countdown Timer
    let countdown = 5;
    setInterval(function() {
        countdown--;
        document.getElementById('countdown').textContent = countdown;
    }, 1000);
</script>
@endscript
