<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $settings->description ?? 'Default description' }}">
  <meta name="keywords" content="{{ $settings->title ?? 'Default keywords' }}">
  <meta name="author" content="{{ $settings->title ?? 'Default author' }}">
  <title>{{ $settings->title ?? 'Default Title' }}</title>

  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous"> --}}
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/core.css') }}">
 <link rel="stylesheet" href="{{ asset('style/assets/vendor/fonts/fontawesome.css') }}">


  <link rel="stylesheet" href="{{ asset('style/assets/vendor/css/rtl/theme-semi-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/demo.css') }}">
  @if($settings && $settings->favicon)
  <link rel="icon" href="{{ asset('storage/' . $settings->favicon) }}" type="image/x-icon">
@endif
@vite('resources/css/app.css')
@vite('resources/js/app.js')
        @livewireStyles()

  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #F4F6F9;
      color: #333333;
    }

    /* Header */
    .header {
      background: linear-gradient(135deg, #4A90E2, #50E3C2);
      color: #ffffff;
      padding: 20px 0;
      text-align: center;
    }
    .header h1 {
      font-size: 3rem;
      font-weight: 600;
      margin-bottom: 10px;
    }
    .header p {
      font-size: 1.2rem;
      font-weight: 400;
    }
    .logo {
  max-width: 300px; /* Adjust max width as needed */
  margin: 0 auto;
}

.logo img {
  width: 50%;
  height: auto; /* Maintain aspect ratio */
}

.subtitle {
  margin-top: 10px;
  font-size: 1.2rem;
  color: #666;
}
    /* Navbar */
    .navbar {
      background-color: #283E4A;
      /* padding: 1rem 0; */
    }
    .navbar-brand {
      font-size: 1.5rem;
      font-weight: 600;
      color: #ffffff;
    }
    .nav-link {
      color: #ffffff !important;
      font-size: 1rem;
      margin-right: 20px; /* Changed to margin-right for RTL */
    }
    .nav-link:hover {
      color: #50E3C2 !important;
      transition: color 0.3s ease;
    }

    /* Content Section */
    .content-section {
      padding: 60px 0;
      text-align: center;
    }
    .content-section h2 {
      font-size: 2.5rem;
      font-weight: 600;
      color: #333333;
      margin-bottom: 20px;
    }
    .content-section p {
      font-size: 1.1rem;
      color: #666666;
      max-width: 700px;
      margin: 0 auto;
    }

    /* Services Section */
    .services-section {
      padding: 60px 0;
      background-color: #ffffff;
    }
    .services-section h2 {
      font-size: 2.5rem;
      font-weight: 600;
      margin-bottom: 40px;
      text-align: center;
      color: #333333;
    }
    .service-card {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease;
    }
    .service-card:hover {
      transform: translateY(-10px);
    }
    .service-card i {
      font-size: 3rem;
      color: #4A90E2;
      margin-bottom: 20px;
    }
    .service-card h4 {
      font-size: 1.5rem;
      margin-bottom: 15px;
      font-weight: 600;
    }
    .service-card p {
      font-size: 1rem;
      color: #666666;
    }
    .service-card .btn-primary {
      margin-top: 20px;
      background-color: #4A90E2;
      border: none;
      padding: 10px 20px;
    }
    .service-card .btn-primary:hover {
      background-color: #50E3C2;
    }

    /* Footer */
    footer {
      background-color: #283E4A;
      color: #ffffff;
      padding: 40px 0;
      text-align: center;
    }
    footer a {
      color: #50E3C2;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
    }
    #filterSection .card-body {
            border-radius: 0.25rem;
            box-shadow: 0 0 0.125rem rgba(0, 0, 0, 0.125);
        }
  </style>
</head>
<body>

  <!-- Header Section -->
  <header class="header">
    <div class="logo">
        @if($settings && $settings->logo)
        <img src="{{ asset('storage/'.$settings->logo) }}" alt="{{$settings->title}}" class="img-fluid">
        @endif
          </div>
      <!-- Optional subtitle if needed -->
  </header>

  <nav class="navbar navbar-expand-lg">
    <div class="container">
        @if($settings && $settings->website_name)
      <a class="navbar-brand" href="/">{{$settings->website_name}}</a>
      @endif
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="تبديل التنقل">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i> الرئيسية</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-star"></i> الميزات</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('send_request') }}"><i class="fas fa-tags"></i> ارسال طلب</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('candidates') }}"><i class="fas fa-user"></i>المرشحين</a>
          </li>

          <!-- Check if the user is authenticated -->
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> عرض الملف الشخصي</a></li>
                <li><a class="dropdown-item" href="{{ route('user-request') }}"><i class="fas fa-user-circle"></i>الطلبات</a></li>

                <li><a class="dropdown-item" href="#"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
              </li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </ul>
          </li>
          @endauth

          <!-- If the user is a guest -->
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> تسجيل الدخول</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> إنشاء حساب</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
</nav>

  <!-- Content Section -->
  {{-- <div class="container content-section">
    <h2>مرحبًا بك في واجهتنا الاحترافية</h2>
    <p>هدفنا هو تقديم خدمات استثنائية وحلول مبتكرة لمساعدة عملك على النجاح في العالم الرقمي. تعاون معنا لتعزيز وجودك الرقمي وتحقيق النجاح.</p>
  </div> --}}

  <!-- Services Section -->
  {{-- <div class="container services-section mt-5">
    <h2>خدماتنا</h2>
    <div class="row">
      <div class="col-md-4">
        <!-- Uncomment and customize as needed
        <div class="service-card">
          <i class="fas fa-laptop-code"></i>
          <h4>تطوير الويب</h4>
          <p>نقوم ببناء مواقع عالية الجودة وقابلة للتوسع لتلبية احتياجات عملك.</p>
        </div>
        -->
      </div>
      <div class="col-md-4">
        <div class="service-card">
          <i class="fas fa-paper-plane"></i>
          <h4>إرسال طلب</h4>
          <p>إذا كان لديك أي طلب يمكنك إرسال الطلب وسنتواصل معك في أقرب وقت.</p>
          <a href="#" class="btn btn-primary">إرسال طلب</a>
        </div>
      </div>
      <div class="col-md-4">
        <!-- Uncomment and customize as needed
        <div class="service-card">
          <i class="fas fa-chart-line"></i>
          <h4>تحسين SEO</h4>
          <p>تعزيز رؤية موقعك وزيادة الحركة باستخدام خدمات SEO لدينا.</p>
        </div>
        -->
      </div>
    </div>
  </div> --}}
{{$slot}}
  <!-- Footer -->
  <footer class="mt-5">
    <div class="container">
      <p>&copy; 2024  جميع الحقوق محفوظة.</p>
    </div>
  </footer>
  @livewireStyles
  @livewireScripts
    <!-- Scripts -->
    <script src="{{ asset('style/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('style/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('style/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('style/js/off-canvas.js') }}"></script>
    <script src="{{ asset('style/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('style/js/template.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('style/assets/vendor/js/bootstrap.js') }}"></script>

    <script src="{{ asset('style/assets/js/main.js') }}"></script>
    <script src="{{ asset('style/assets/js/forms-editors.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{asset('style/assets/vendor/libs/quill/katex.js')}}"></script>
  <script src="{{asset('style/assets/vendor/libs/quill/quill.js')}}"></script>
    <script src="../../assets/js/main.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script> --}}
  @stack('scripts')

</body>
</html>
