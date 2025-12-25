<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DAB - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg-dark: #0b0f18; /* bg-dark-900 vibe */
            --card: #0f1720;
            --muted: #9aa4b2;
            --text: #e6eef8;
            --accent-1: #4f7cff; /* primary blue */
            --accent-2: #6ad1c9; /* secondary teal */
            --border: rgba(255,255,255,0.04);
            --input-bg: rgba(255,255,255,0.02);
            --shadow: 0 12px 30px rgba(2,6,23,0.6);
            --icon: #98a6d0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height:100%; }
        body{
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text);
            min-height: 100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        /* Background decorative elements - very subtle on dark */
        .bg-egg{ position: fixed; width:120px; height:160px; background: linear-gradient(180deg, rgba(79,124,255,0.06), rgba(106,209,201,0.03)); border-radius:50% 50% 50% 50% / 60% 60% 40% 40%; opacity:0.06; z-index:0; pointer-events:none; }
        .bg-egg:nth-child(1){ top:6%; left:4%; transform:rotate(25deg); width:80px; height:100px; }
        .bg-egg:nth-child(2){ bottom:12%; right:6%; transform:rotate(-18deg); width:120px; height:150px; }
        .bg-feather{ position: fixed; font-size:120px; color:var(--accent-2); opacity:0.03; z-index:0; pointer-events:none; }
        .bg-feather:nth-child(3){ top:4%; right:10%; transform: rotate(40deg); }
        .bg-feather:nth-child(4){ bottom:8%; left:8%; transform: rotate(-20deg); }

        .container{
            display:flex;
            max-width:900px;
            width:100%;
            background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
            border-radius:16px;
            box-shadow: var(--shadow);
            overflow:hidden;
            position:relative;
            z-index:1;
        }

        .illustration-side{
            flex:1;
            background: linear-gradient(135deg, rgba(15,23,32,0.8), rgba(12,16,24,0.9));
            padding:32px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            min-height:560px;
            position:relative;
        }

        .logo{ position:absolute; top:22px; left:22px; display:flex; align-items:center; font-family:'Quicksand',sans-serif; font-weight:700; font-size:20px; color:var(--text); z-index:2; }
        .logo i{ margin-right:8px; color:var(--accent-1); }

        .chicken-container{ width:250px; height:250px; position:relative; margin-bottom:18px; display:flex; align-items:center; justify-content:center; }
        .chicken-image{ width:100%; height:100%; object-fit:contain; filter: drop-shadow(0 12px 24px rgba(0,0,0,0.6)); animation: float 4s ease-in-out infinite; transition: transform 0.3s ease; }
        .chicken-shadow{ position:absolute; bottom:14px; width:150px; height:30px; background: radial-gradient(ellipse at center, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0) 70%); border-radius:50%; animation: shadowPulse 4s ease-in-out infinite; z-index:0; }

        .illustration-text{ text-align:center; color:var(--muted); max-width:320px; z-index:2; }
        .illustration-text h2{ font-size:22px; margin-bottom:10px; color:var(--text); font-family:'Quicksand',sans-serif; }
        .illustration-text p{ font-size:14px; line-height:1.5; color:var(--muted); }

        .login-side{ flex:1; padding:40px 36px; display:flex; flex-direction:column; justify-content:center; min-height:560px; overflow-y:auto; }
        .login-header h1{ font-size:26px; color:var(--text); margin-bottom:8px; font-family:'Quicksand',sans-serif; }
        .login-header p{ color:var(--muted); font-size:14px; }

        .login-form{ width:100%; flex-grow:1; display:flex; flex-direction:column; }
        .input-group{ position:relative; margin-bottom:18px; width:100%; }
        .input-group i{ position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--icon); font-size:16px; z-index:1; }
        .input-group input{ width:100%; padding:13px 13px 13px 44px; border:1px solid var(--border); border-radius:10px; font-size:15px; transition:all .25s; background:var(--input-bg); color:var(--text); -webkit-appearance:none; }
        .input-group input::placeholder{ color:transparent; }
        .input-group input:focus{ outline:none; border-color:var(--accent-1); box-shadow:0 0 0 4px rgba(79,124,255,0.12); }
        .input-group label{ position:absolute; left:44px; top:50%; transform:translateY(-50%); color:var(--muted); pointer-events:none; transition:all .25s; background:transparent; padding:0 6px; font-size:14px; }
        .input-group input:focus + label, .input-group input:not(:placeholder-shown) + label{ top:-8px; font-size:12px; color:var(--accent-1); background:transparent; }

        .remember-forgot{ display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; font-size:13px; color:var(--muted); flex-wrap:wrap; }
        .remember input{ margin-right:6px; accent-color:var(--accent-1); }
        .forgot-link{ color:var(--accent-1); text-decoration:none; }
        .forgot-link:hover{ text-decoration:underline; }

        .login-btn{ width:100%; padding:13px; background: linear-gradient(90deg,var(--accent-1),var(--accent-2)); color:#061022; border:none; border-radius:10px; font-size:16px; font-weight:700; cursor:pointer; transition:all .25s; box-shadow: 0 8px 28px rgba(79,124,255,0.18); }
        .login-btn:hover{ transform:translateY(-3px); box-shadow:0 14px 40px rgba(79,124,255,0.22); }

        .social-login{ text-align:center; margin-bottom:18px; }
        .social-login p{ color:var(--muted); margin-bottom:12px; position:relative; font-size:13px; }
        .social-login p::before, .social-login p::after{ content:""; position:absolute; top:50%; width:25%; height:1px; background-color: rgba(255,255,255,0.03); }
        .social-login p::before{ left:0; }
        .social-login p::after{ right:0; }
        .social-icons{ display:flex; justify-content:center; gap:12px; }
        .social-icon{ width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--text); font-size:16px; cursor:pointer; transition:all .25s; flex-shrink:0; background:rgba(255,255,255,0.02); }
        .social-icon.facebook{ background:#13233f; }
        .social-icon.google{ background:#3b2a22; }
        .social-icon.twitter{ background:#081b2a; }
        .social-icon:hover{ transform:translateY(-5px); box-shadow:0 8px 20px rgba(0,0,0,0.6); }

        .register-link{ text-align:center; font-size:14px; color:var(--muted); margin-top:auto; padding-top:10px; }
        .register-link a{ color:var(--accent-1); text-decoration:none; font-weight:600; }

        @keyframes float{ 0%,100%{ transform:translateY(0) rotate(0deg); } 25%{ transform: translateY(-12px) rotate(0.5deg); } 50%{ transform: translateY(-20px) rotate(-0.6deg); } 75%{ transform: translateY(-12px) rotate(0.4deg); } }
        @keyframes shadowPulse{ 0%,100%{ transform:scale(1); opacity:0.7; } 50%{ transform:scale(0.85); opacity:0.45; } }

        /* Responsive tweaks: keep original layout but dark-friendly */
        @media (max-width:1100px){ .container{ max-width:85%; } }
        @media (max-width:992px){ .container{ max-width:90%; } .illustration-side, .login-side{ min-height:500px; } .chicken-container{ width:200px; height:200px; } }

        /* @media (max-width:768px){ body{ padding:15px; align-items:flex-start; } .container{ flex-direction:column; max-width:100%; border-radius:12px; } .illustration-side{ min-height:180px; height:180px; padding:15px; flex-direction:row; align-items:center; justify-content:space-between; } .logo{ position:relative; font-size:20px; margin-right:15px; } .chicken-container{ width:120px; height:120px; position:absolute; right:20px; top:50%; transform:translateY(-50%); } .chicken-shadow{ width:80px; height:15px; bottom:10px; } .illustration-text{ max-width:calc(100% - 140px); text-align:left; } .illustration-text p{ display:none; } .login-side{ padding:30px 25px; } } */
        @media (max-width:768px){
            .hide-mobile {
                display: none !important;
            }
            body {
                padding:15px;
                align-items:flex-start;
            }
            .container{
                flex-direction:column;
                max-width:100%;
                border-radius:12px;
            }
            .illustration-side{
                min-height:auto;
                height:auto;
                padding:20px 15px;
                flex-direction:column; /* stack vertically */
                align-items:center;
                justify-content:center;
                text-align:center;
            }
            .logo {
                position:relative;
                font-size:20px;
                margin-bottom:20px; /* space below logo */
            }
            .chicken-container {
                width:150px;
                height:150px;
                margin-bottom:15px; /* space below image */
                position:relative;
                transform:none;
            }
            .chicken-shadow{
                width:100px;
                height:15px;
                bottom:10px;
            }
            .illustration-text{
                max-width:90%;
            }
            .illustration-text p{
                display:block; /* show text under logo/image */
            }
        }

        @media (max-width:480px){ .illustration-side{ height:150px; } .chicken-container{ width:100px; height:100px; right:15px; } .chicken-shadow{ width:60px; height:12px; bottom:8px; } .login-side{ padding:25px 20px; } .login-header h1{ font-size:22px; } .social-icon{ width:35px; height:35px; font-size:14px; } }
        @media (max-width:360px){ .illustration-side{ height:140px; } .chicken-container{ width:90px; height:90px; right:10px; } .login-side{ padding:20px 15px; } .input-group i{ left:12px; font-size:14px; } .input-group label{ left:40px; font-size:13px; } }

        /* iOS viewport fix */
        @supports (-webkit-touch-callout: none){ body{ min-height: -webkit-fill-available; } }
    </style>
</head>
<body>
    <!-- Background decorative elements -->
    <div class="bg-egg"></div>
    <div class="bg-egg"></div>
    <div class="bg-feather"><i class="fas fa-feather-alt"></i></div>
    <div class="bg-feather"><i class="fas fa-feather-alt"></i></div>

    <div class="container">
        <!-- Left side with illustration -->
        <div class="illustration-side">
            <div class="logo hide-mobile">
                <i class="fas fa-egg"></i>
                DAB
            </div>

            <div class="chicken-container">
                <div class="chicken-shadow"></div>
                <!-- Chicken image with transparent background and safe fallback -->
                <img src="https://static.vecteezy.com/system/resources/thumbnails/028/670/871/small/pink-pig-isolated-on-transparent-background-side-view-cute-pig-generative-ai-png.png"
                     alt="Chicken"
                     class="chicken-image"
                     onerror="this.onerror=null;this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'250\' height=\'250\' viewBox=\'0 0 250 250\'><rect width=\'100%\' height=\'100%\' fill=\'%230c1117\'/><text x=\'50%\' y=\'55%\' text-anchor=\'middle\' fill=\'%2398a6d0\' font-family=\'Poppins, sans-serif\' font-size=18>Chicken</text></svg>'"/>
            </div>

            <div class="illustration-text hide-mobile">
                <h2>{{ env('APP_NAME') }}</h2>
                <p>Monitor your flock, track your sales and expenses, manage feed inventory, and optimize your farm business.</p>
            </div>
        </div>

        <!-- Right side with login form -->
        <div class="login-side">
            <div class="login-header">
                <h1>{{ env('APP_NAME') }}</h1>
                {{-- <h1>Welcome Back</h1> --}}
                <p>Sign in to access your dashboard</p>
            </div>

            <br>

            <form action="{{ url('login') }}" method="post" class="login-form" id="loginForm">
              @csrf

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="email" id="email" name="email" placeholder=" " required value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                        <span style="color:#ff4c4c; font-size:13px; margin-top:4px; display:block;">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder=" " required>
                    <label for="password">Password</label>
                </div>

              <div class="remember-forgot">
                  <div class="remember">
                      <input type="checkbox" id="remember" name="remember">
                      <label for="remember">Remember me</label>
                  </div>
                  <a href="{{ route('forgot-password') }}" class="forgot-link">Forgot password?</a>
              </div>

              <button type="submit" class="login-btn">
                  <i class="fas fa-sign-in-alt"></i> Sign In
              </button>

              <div class="social-login">
                <br>
                  {{-- <p>Or continue with</p> --}}
                  <div class="social-icons">
                      <div class="social-icon facebook"><i class="fab fa-facebook-f"></i></div>
                      <div class="social-icon google"><i class="fab fa-google"></i></div>
                      <div class="social-icon twitter"><i class="fab fa-twitter"></i></div>
                  </div>
              </div>

              <div class="register-link">
                  Developed by <a target="blank" href="https://benjastech.com">Benjas Technologies</a>
              </div>
          </form>

        </div>
    </div>

    <script>
        // Validate, then submit normally to Laravel
        document.getElementById('loginForm').addEventListener('submit', function(e) {

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!email || !password) {
                e.preventDefault(); // stop submission ONLY on error
                alert('Please fill in all fields');
                return;
            }

            // Otherwise, allow the form to submit normally
            // Laravel will handle redirecting after login
        });

        // Forgot password click
        // document.querySelector('.forgot-link').addEventListener('click', function(e) {
        //     e.preventDefault();
        //     alert('Password reset link sent to your email');
        // });

        // Social login demo
        // document.querySelectorAll('.social-icon').forEach(icon => {
        //     icon.addEventListener('click', function() {
        //         const platform = this.classList.contains('facebook') ? 'Facebook' :
        //                         this.classList.contains('google') ? 'Google' : 
        //                         'Twitter';
        //         alert(`Connecting with ${platform}...`);
        //     });
        // });

        // Chicken image animations
        const chickenImage = document.querySelector('.chicken-image');
        if (chickenImage) {
            chickenImage.addEventListener('mouseenter', () => {
                chickenImage.style.transform = 'translateY(-10px) scale(1.05)';
            });

            chickenImage.addEventListener('mouseleave', () => {
                chickenImage.style.transform = 'translateY(0) scale(1)';
            });

            chickenImage.addEventListener('click', () => {
                chickenImage.style.animation = 'none';
                setTimeout(() => {
                    chickenImage.style.animation = 'float 4s ease-in-out infinite';
                }, 10);

                playChickenSound();
            });
        }

        function playChickenSound() {
            try {
                const audio = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-rooster-crowing-in-the-morning-2465.mp3');
                audio.volume = 0.3;
                audio.play().catch(e => console.log("Audio play failed:", e));
            } catch (e) {
                console.log("Audio not supported or blocked");
            }
        }


        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = 'Authenticating...';
        });
    
    </script>

</body>
</html>
