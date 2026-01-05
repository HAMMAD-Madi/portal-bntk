<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
    --primary:#39B169;
    --text:#2b2b2b;
    --muted:#7a7a7a;
    --bg-gradient: linear-gradient(135deg, #39B169 0%, #2ca85b 100%);
}

*{
    box-sizing:border-box;
    font-family:"Inter","Segoe UI",Roboto,Arial,sans-serif;
    margin:0;
    padding:0;
}

body{
    min-height:100vh;
    background:#f4f6f9;
}

/* =========================
   Layout
========================= */
.login-wrapper{
    display:flex;
    height:100vh;
    flex-wrap:wrap;
}

/* =========================
   LEFT SIDE
========================= */
.login-left{
    flex:1;
    min-width:320px;
    background:#ffffff;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:30px;
    position:relative;
    overflow:hidden;
}

.login-left::after{
    content:"";
    position:absolute;
    top:0;
    right:0;
    width:1px;
    height:100%;
    background:rgba(0,0,0,0.08);
}

.login-card{
    width:100%;
    max-width:400px;
    padding:48px 36px;
    border-radius:14px;
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
    animation:fadeUp .6s ease;
    background:#fff;
    transition:transform 0.3s ease, box-shadow 0.3s ease;
}

.login-card:hover{
    transform:translateY(-4px);
    box-shadow:0 25px 50px rgba(0,0,0,0.15);
}

@keyframes fadeUp{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

.login-card h2{
    font-size:28px;
    color:var(--text);
    margin-bottom:10px;
    font-weight:600;
}

.login-card p{
    color:var(--muted);
    margin-bottom:32px;
    font-size:15px;
}

/* =========================
   Floating Fields
========================= */
.field{
    position:relative;
    margin-bottom:22px;
}

.field input{
    width:100%;
    padding:16px 14px;
    border:1px solid #dcdcdc;
    border-radius:8px;
    font-size:15px;
    background:transparent;
    transition:border 0.3s, box-shadow 0.3s;
}

.field input:focus{
    border-color:var(--primary);
    box-shadow:0 4px 12px rgba(57,177,105,0.25);
    outline:none;
}

.field label{
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    background:#fff;
    padding:0 6px;
    font-size:14px;
    color:var(--muted);
    pointer-events:none;
    transition:.25s ease;
}

.field input:focus + label,
.field input:not(:placeholder-shown) + label{
    top:-8px;
    font-size:12px;
    color:var(--primary);
}

/* =========================
   Button
========================= */
.login-btn{
    width:100%;
    padding:16px;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:600;
    color:#ffffff;
    background:var(--primary);
    cursor:pointer;
    transition:.3s ease;
    box-shadow:0 8px 20px rgba(57,177,105,0.35);
}

.login-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 28px rgba(57,177,105,0.45);
}

.login-btn:active{
    transform:scale(.98);
}

/* =========================
   RIGHT SIDE
========================= */
.login-right{
    flex:1;
    min-width:320px;
    background:var(--bg-gradient);
    display:flex;
    align-items:center;
    justify-content:center;
    padding:50px 30px;
    position:relative;
    overflow:hidden;
    color:#fff;
}

.login-right::before{
    content:"";
    position:absolute;
    inset:20px;
    border:1px solid rgba(255,255,255,0.45);
    border-radius:18px;
    box-shadow:
        inset 0 0 0 1px rgba(255,255,255,0.25),
        0 20px 40px rgba(0,0,0,0.15);
    pointer-events:none;
}

.login-right-content{
    position:relative;
    z-index:2;
    text-align:center;
    max-width:400px;
    animation:fadeUp 0.8s ease 0.3s forwards;
    opacity:0;
}

.login-right-content h1{
    font-size:38px;
    margin-bottom:16px;
    font-weight:700;
    letter-spacing:.3px;
}

.login-right-content p{
    font-size:16px;
    line-height:1.6;
    opacity:.95;
}

/* =========================
   Responsive Adjustments
========================= */
@media(max-width:1024px){
    .login-wrapper{
        flex-direction:column-reverse;
        justify-content:center;
        align-items:center;
    }

    .login-left, .login-right{
        width:100%;
        flex:none;
    }

    .login-left{
        padding:30px 20px;
    }

    .login-card{
        padding:36px 28px;
    }

    .login-right{
        padding:40px 20px;
        min-height:200px;
    }

    .login-right-content h1{
        font-size:28px;
    }

    .login-right-content p{
        font-size:14px;
    }
}

@media(max-width:600px){
    .login-card{
        width:95%;
        padding:28px 20px;
    }

    .login-right{
        padding:30px 15px;
        min-height:180px;
    }

    .login-right-content h1{
        font-size:24px;
    }

    .login-right-content p{
        font-size:13px;
    }
}

@media(max-width:400px){
    .login-card{
        padding:20px 15px;
    }

    .login-right-content h1{
        font-size:20px;
    }

    .login-right-content p{
        font-size:12px;
    }
}
</style>
</head>
<body>

<div class="login-wrapper">

    <!-- LEFT -->
    <div class="login-left">
        <div class="login-card">
            <h2>Welcome Back</h2>
            <p>Please sign in to continue</p>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                @if ($errors->any())
                    <div style="margin-bottom:16px; color:#e74c3c; font-size:14px; font-weight:500;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="field">
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder=" ">
                    <label>Email Address</label>
                </div>

                <div class="field">
                    <input type="password" name="password" required placeholder=" ">
                    <label>Password</label>
                </div>

                <button class="login-btn">Sign In</button>
            </form>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="login-right">
        <div class="login-right-content">
            <h1>Secure Portal</h1>
            <p>
                Access your dashboard, manage your data,
                and monitor activity in one secure platform.
            </p>
        </div>
    </div>

</div>

</body>
</html>
