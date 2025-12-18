<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  @php
  $getHeaderSetting = App\Models\Setting::getSingle();
  @endphp
  <link href="{{ $getHeaderSetting->getFavicon() }}" rel="icon" type="image/jpg">

  <!-- Google Font: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #6e00ff, #a000c8);
      color: #fff;
    }

    .login-box {
      width: 100%;
      max-width: 400px;
      margin: 50px auto;
    }

    .card {
      border-radius: 20px;
      background: rgba(0, 0, 0, 0.85);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
    }

    .card-header {
      border-bottom: none;
      background: transparent;
      text-align: center;
      font-size: 24px;
      font-weight: 700;
      color: #fff;
    }

    .card-body {
      padding: 30px 25px;
    }

    /* Input floating label effect */
    .input-group {
      position: relative;
      margin-bottom: 25px;
    }

    .input-group input {
      width: 100%;
      padding: 14px 14px 14px 45px;
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      background: rgba(255, 255, 255, 0.05);
      color: #fff;
      font-size: 15px;
      outline: none;
      transition: all 0.3s ease;
    }

    .input-group input:focus {
      border-color: #6e00ff;
      box-shadow: 0 0 0 4px rgba(110, 0, 255, 0.2);
      background: rgba(255, 255, 255, 0.08);
    }

    .input-group i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      font-size: 16px;
    }

    .input-group input::placeholder {
      color: transparent;
    }

    .input-group label {
      position: absolute;
      left: 45px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.6);
      font-size: 14px;
      pointer-events: none;
      transition: all 0.3s ease;
    }

    .input-group input:focus+label,
    .input-group input:not(:placeholder-shown)+label {
      top: -8px;
      font-size: 12px;
      color: #6e00ff;
    }

    /* Button style */
    .btn-primary {
      width: 100%;
      padding: 14px;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      background: linear-gradient(90deg, #6e00ff, #a000c8);
      border: none;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    /* Back link */
    .back-link {
      text-align: center;
      margin-top: 20px;
      color: rgba(255, 255, 255, 0.7);
      font-size: 14px;
    }

    .back-link a {
      color: #fff;
      text-decoration: underline;
    }

    /* Validation message */
    .error-text {
      color: #ff4c4c;
      font-size: 13px;
      margin-top: 4px;
      display: block;
    }

    /* Responsive */
    @media (max-width: 480px) {
      .login-box {
        margin: 30px auto;
      }

      .card-body {
        padding: 20px;
      }
    }
  </style>
</head>

<body>
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header">
        Forgot Password
      </div>
      <div class="card-body">

        @include('_message')

        <form action="" method="post" id="forgotForm">
          @csrf

          <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" class="form-control" name="email" placeholder=" " required
              value="{{ old('email') }}">
            <label>Email Address</label>

            @error('email')
            <span class="error-text">{{ $message }}</span>
            @enderror
          </div>

          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Request Reset Link Now</button>
            </div>
          </div>
        </form>

        <div class="back-link">
          <a href="{{ route('login') }}">Back to Login Page</a>
        </div>

      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

  <script>
    // Frontend validation & button feedback
    document.getElementById('forgotForm').addEventListener('submit', function (e) {
      const email = this.email.value.trim();

      if (!email) {
        e.preventDefault();
        alert('Please enter your email.');
        return false;
      }

      const btn = this.querySelector('button[type="submit"]');
      btn.disabled = true;
      btn.innerHTML = 'Sending...';
    });
  </script>
</body>

</html>
