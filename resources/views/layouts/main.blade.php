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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body{
            font-family: 'Cairo', sans-serif;
            background-color: #f0f0f0
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
            color:#ffca00;
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
        }
    </style>
    @yield('style')
    <title>مكتبتي</title>
</head>
<body dir="rtl" style="text-align: right">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-warning">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ url('/')}}">مكتبتي</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    @auth
                    <li class="nav-item">
                        <a href="{{--route('cart.view')--}}" class="nav-link"></a>
                        @if (Auth::user()->bookInCart()->count() > 0)
                        <span class="badge bg-secondary">{{Auth::user()->bookInCart()->count()}}</span>
                        
                        @else
                        <span class="badge bg-secondary">0</span>
                        @endif
                        العربة
                    </li>
                    @endauth
                        
                    <li class="nav-item">
                        <a href="{{route('categor.list')}}" class="nav-link">
                            التصنيفات
                            <i class="bi bi-card-list"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('publisher.list')}}" class="nav-link">
                            الناشرون
                            <i class="bi bi-table"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('auther.list')}}" class="nav-link">
                            المؤلفون
                            <i class="bi bi-pen"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            مشترياتي
                            <i class="bi bi-cart4"></i>
                        </a>
                    </li>
                    
                </ul>

                <ul class="navbar-av mr-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}">{{__('تسجيل الدخول')}}</a>
                        
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register')}}">{{__('انشاء حساب جديد')}}</a>
                        
                        </li>
                    @endif
                    @else
                    <li class="nav-item dropdown justify-content-left">
                        <a href="#" class="nav-link " data-bs-toggle="dropdown" id="navbarDropdown">
                            <img  class=" rounded-circle object-fit-cover h-8 w-8"  src="{{asset("storage/" .Auth::user()->profile_photo_path)}}" alt="{{Auth::user()->name}}">
                        
                        </a>
                        <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2">
                            @can('update_books')
                                <a class="dropdown-item" href="{{route('admin.index')}}">لوحة الادارة</a>
                            @endcan
    

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>
                        
                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
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
<!-- GSAP for advanced animations -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>

<!-- Three.js for 3D effects -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<!-- FontAwesome for icons -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
@yield('script')
@livewireScripts
</body>
</html>