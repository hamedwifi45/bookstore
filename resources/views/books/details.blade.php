@extends('layouts.main')

@section('style')
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: #fff;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        margin: 50px 0;
        perspective: 1000px;
    }

    .product-image {
        flex: 1 1 40%;
        position: relative;
        transform-style: preserve-3d;
        animation: float 6s ease-in-out infinite;
    }

    .product-image img {
        max-width: 100%;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        transform: rotateY(20deg) rotateX(10deg);
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    .product-image img:hover {
        transform: rotateY(0) rotateX(0);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
    }

    .product-details {
        flex: 1 1 55%;
        padding: 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .product-details h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .product-details p {
        margin: 10px 0;
        font-size: 1.1rem;
        color: #ddd;
    }

    .price {
        font-size: 1.8rem;
        color: #ffdd57;
        margin: 15px 0;
        font-weight: bold;
    }

    .btn-add-to-cart {
        background-color: #ff6f61;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-add-to-cart:hover {
        background-color: #ff3b2f;
        transform: scale(1.1);
    }

    .description, .reviews, .suggestions {
        margin-top: 40px;
        padding: 25px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .description h2, .reviews h2, .suggestions h2 {
        font-size: 2rem;
        margin-bottom: 20px;
        color: #fff;
    }

    .description p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #ddd;
    }

    .reviews .review {
        margin-bottom: 20px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        backdrop-filter: blur(10px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .reviews .review h5 {
        font-size: 1.2rem;
        margin: 0;
        color: #ffdd57;
    }

    .reviews .review small {
        color: #bbb;
    }

    .reviews .review p {
        margin: 10px 0;
        font-size: 1rem;
        color: #ddd;
    }

    .suggestions ul {
        list-style: none;
        padding: 0;
    }

    .suggestions ul li {
        margin-bottom: 10px;
    }

    .suggestions ul li a {
        font-size: 1.1rem;
        color: #ff6f61;
        text-decoration: none;
        transition: color 0.3s;
    }

    .suggestions ul li a:hover {
        color: #ff3b2f;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
    }
</style>
@endsection
@section('content')
    <div class="container">
        <div class="product-container">
            <div class="product-image">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" id="book-cover">
            </div>
            <div class="product-details">
                <h1>{{ $book->title }}</h1>
                <div class="rating-stars">
                    <span class="score">
                        <div class="score-warp">
                            <span class="star-active" style="width: {{$book->rate() * 20}}%">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="star-inactive">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                        </div>
                    </span>
                </div>
                <p><strong>عدد المقيمين:</strong> {{ $book->ratings()->count() }}</p>
                <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
                <p><strong>التصنيف:</strong> {{ $book->categor ? $book->categor->name : 'غير متوفر' }}</p>
                <p><strong>المؤلف:</strong> 
                    @if ($book->auther->count() > 0)
                        @foreach ($book->auther as $auther)
                            {{$loop->first ? '' : 'و'}}{{$auther->name}}
                        @endforeach
                    @else
                        غير متوفر
                    @endif
                </p>
                <p><strong>الناشر:</strong> {{ $book->publisher ? $book->publisher->name : 'غير متوفر' }}</p>
                <p><strong>سنة النشر:</strong> {{ $book->publish_year }}</p>
                <p><strong>عدد الصفحات:</strong> {{ $book->number_of_page }} صفحة</p>
                <p><strong>عدد النسخ:</strong> {{ $book->number_of_copy }} نسخة</p>
                <p class="price">{{ $book->price }} ليرة سورية</p>
                @auth
                    <div class="form text-center mb-2">
                        <input type="hidden" id="bookId" value="{{$book->id}}">
                        <span class="text-muted mb-3"><input class="form-control d-inline mx-auto" name="quanity" required id="quanity" value="1" min="1" style="width: 10%" max="{{$book->number_of_copy}}" type="number"></span>
                        <button type="submit" class="btn-add-to-cart addCart">أضف إلى السلة</button>
                    </div>
                @endauth
            </div>
        </div>
        <div class="description">
            <h2>الوصف</h2>
            <p>{{ $book->description }}</p>
        </div>
        @auth
        <div class="reviews">
            <h2>التقييمات والتعليقات</h2>
            <form action="{{ route('book.rate', $book->id) }}" method="POST">
                @csrf
                {{-- <div class="form-group">
                    <label for="content">أضف تعليقك:</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div> --}}
                <div class="form-group">
                    <label for="rating">تقييم:</label>
                    <select name="value" id="rating" class="form-control" required>
                        <option selected disabled >   اختر تصنيفا   </option>
                        <option value="1">   1   </option>
                        <option value="2">   2   </option>
                        <option value="3">   3   </option>
                        <option value="4">   4   </option>
                        <option value="5">   5   </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">إرسال</button>
            </form>
        </div>    
        @endauth
        
        {{-- <div class="suggestions"> --}}
            {{-- <h2>كتب مقترحة</h2> --}}
            <ul>
                {{-- @foreach($suggestedBooks as $suggestedBook)
                    <li>
                        <a href="{{ route('books.show', $suggestedBook->id) }}">{{ $suggestedBook->title }}</a> - {{ $suggestedBook->author->name }}
                    </li>
                @endforeach --}}
            </ul>
        </div>
    </div>
    
    @endsection
    @section('script')
    <script>
        // GSAP Animations
        gsap.from(".product-container", { duration: 1.5, opacity: 0, y: 50, ease: "power2.out" });
        gsap.from(".description", { duration: 1.5, opacity: 0, y: 50, ease: "power2.out", delay: 0.5 });
        gsap.from(".reviews", { duration: 1.5, opacity: 0, y: 50, ease: "power2.out", delay: 1 });
        gsap.from(".suggestions", { duration: 1.5, opacity: 0, y: 50, ease: "power2.out", delay: 1.5 });
    
        // 3D Hover Effect
        const bookCover = document.getElementById('book-cover');
        bookCover.addEventListener('mousemove', (e) => {
            const xAxis = (window.innerWidth / 2 - e.pageX) / 20;
            const yAxis = (window.innerHeight / 2 - e.pageY) / 20;
            bookCover.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
    
        bookCover.addEventListener('mouseleave', () => {
            bookCover.style.transform = 'rotateY(20deg) rotateX(10deg)';
        });
        $('.addCart').on('click', function(event) {
        event.preventDefault();
        var token = '{{ session()->token() }}';
        var url = '{{ route('cart.add') }}';
    
        var bookId = $(this).parent('.form').find('#bookId').val();
        var quanity = $(this).parent('.form').find('#quanity').val();
        console.log(bookId);
    
        $.ajax({
            method: 'post',
            url: url,
            data: {
                quanity: quanity,
                id: bookId,
                _token: token
            },
            success: function(data) {
                $('span.badge').text(data.num_of_prod);
                toastr.success('تم اضافة الطلب بنجاح');
            },
            error: function() {
                alert('حدث خطأ');
            }
        });
    });
    </script>
@endsection