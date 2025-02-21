<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @livewireStyles
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f0f0;
        }

        /* أنميشنات مخصصة */
        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
        }
           
        .score{
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        .score-warp{
            display: inline-block;
            position: relative;
            height: 19px;
        }
        .score .star-active{
            color:#0800ff;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap
        }
        .score .star-inactive{
            color: lightgray;
            position: absolute;
            top: 0;
            left: 0;
        } to { transform: translateY(0); opacity: 1; }
        

        .navbar {
            animation: slideIn 0.5s ease-out;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #6c5ce7 0%, #4a3fcf 100%); /* تغيير الألوان */
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
            padding: 10px 15px !important;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff !important; /* تغيير لون النص */
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .nav-link:hover::after {
            width: 80%;
            left: 10%;
        }

        .badge {
            transition: transform 0.3s ease;
            background-color: #ff7675 !important; /* تغيير لون البادج */
        }

        .badge:hover {
            transform: scale(1.1) rotate(10deg);
        }

        .dropdown-menu {
            animation: slideIn 0.3s ease-out !important;
            border: none !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            background-color: #6c5ce7; /* تغيير لون القائمة المنسدلة */
        }

        .dropdown-item {
            color: #fff !important; /* تغيير لون النص */
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #4a3fcf; /* تغيير لون الهفر */
            transform: translateX(10px);
        }

        .profile-img {
            transition: transform 0.3s ease;
            border: 2px solid transparent;
        }

        .profile-img:hover {
            transform: scale(1.1);
            border-color: #fff;
        }

        /* تحسينات عامة */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff !important; /* تغيير لون النص */
        }

        .navbar-brand::before {
            content: "\f02d";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: #fff;
        }
    </style>
    @yield('style')
    <title>مكتبتي</title>
</head>
<body dir="rtl" style="text-align: right">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/')}}">مكتبتي</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        @auth
                        <li class="nav-item">
                            <a href="{{route('cart.view')}}" class="nav-link position-relative">
                                <i class="bi bi-cart3"></i>
                                العربة
                                @if (Auth::user()->bookInCart()->count() > 0)
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                    {{Auth::user()->bookInCart()->count()}}
                                    <span class="visually-hidden">المنتجات في السلة</span>
                                </span>
                                @endif
                            </a>
                        </li>
                        @endauth
                            
                        <li class="nav-item">
                            <a href="{{route('categor.list')}}" class="nav-link">
                                <i class="bi bi-bookmarks-fill"></i>
                                التصنيفات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('publisher.list')}}" class="nav-link">
                                <i class="bi bi-building"></i>
                                الناشرون
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('auther.list')}}" class="nav-link">
                                <i class="bi bi-pen"></i>
                                المؤلفون
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-bag-check-fill"></i>
                                مشترياتي
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mr-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login')}}">
                                <i class="bi bi-box-arrow-in-left"></i>
                                {{__('تسجيل الدخول')}}
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register')}}">
                                    <i class="bi bi-person-plus"></i>
                                    {{__('انشاء حساب جديد')}}
                                </a>
                            </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                <img class="profile-img rounded-circle object-fit-cover" 
                                     style="width: 40px; height: 40px;" 
                                     src="{{asset("storage/" .Auth::user()->profile_photo_path)}}" 
                                     alt="{{Auth::user()->name}}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-start z-3  px-2 mt-2">
                                @can('update_books')
                                    <a class="dropdown-item" href="{{route('admin.index')}}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        لوحة الادارة
                                    </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    <i class="bi bi-person-circle me-2"></i>
                                    الملف الشخصي
                                </a>
                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
                                        <i class="bi bi-key me-2"></i>
                                        API Tokens
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        تسجيل الخروج
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        // أنميشن عند التمرير
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            const navbar = document.querySelector('.navbar');
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                gsap.to(navbar, {y: '-100%', duration: 0.3});
            } else {
                gsap.to(navbar, {y: '0%', duration: 0.3});
            }
            lastScroll = currentScroll;
        });

        // أنميشن عند تحميل الصفحة
        gsap.from('.nav-item', {
            duration: 0.8,
            opacity: 0,
            y: 20,
            stagger: 0.1,
            ease: "power2.out"
        });

        // تأثير هافر للروابط
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('mouseenter', () => {
                gsap.to(link, {
                    scale: 1.05,
                    duration: 0.3
                });
            });
            
            link.addEventListener('mouseleave', () => {
                gsap.to(link, {
                    scale: 1,
                    duration: 0.3
                });
            });
        });
    </script>
    @yield('script')
    @livewireScripts
</body>
</html>