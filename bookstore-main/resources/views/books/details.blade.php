@extends('layouts.main')

@section('style')
<style>
    body {
        font-family: 'Cairo', sans-serif;
        background: linear-gradient(to bottom, #f3f3f3, #fff);
        animation: backgroundGradient 10s ease-in-out infinite;
    }

    .fade-in {
        animation: fadeIn 1s ease-in-out;
        opacity: 1;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: flex-start;
        margin: 20px 0;
    }

    .product-image {
        flex: 1 1 40%;
        margin-right: 30px; /* زيادة المسافة بين الصورة والنص */
    }

    .product-image img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        flex: 1 1 55%;
    }

    .product-details h1 {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .product-details p {
        margin: 5px 0;
    }

    .price {
        font-size: 1.5rem;
        color: #007bff;
        margin: 10px 0;
    }

    .btn-add-to-cart {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-add-to-cart:hover {
        background-color: #218838;
    }

    .description {
        margin-top: 30px; /* إضافة مسافة أعلى الوصف */
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .reviews {
        margin-top: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .review {
        margin-bottom: 15px;
    }

    .review h5 {
        margin: 0;
    }

    .suggestions {
        margin-top: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .suggestions h2 {
        margin-bottom: 15px;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes backgroundGradient {
        0% {
            background: linear-gradient(to bottom, #f3f3f3, #fff);
        }
        50% {
            background: linear-gradient(to bottom, #fff, #f3f3f3);
        }
        100% {
            background: linear-gradient(to bottom, #f3f3f3, #fff);
        }
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="fade-in product-container">
            <div class="product-image">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
            </div>
            <div class="product-details p-3">
                <h1>{{ $book->title }}</h1>
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
                <button class="btn-add-to-cart">أضف إلى السلة</button>
            </div>
        </div>
        <div class="fade-in description">
            <h2>الوصف</h2>
            <p>{{ $book->description }}</p>
        </div>

        <!-- قسم التقييمات -->
        <div class="fade-in reviews">
            <h2>التقييمات والتعليقات</h2>
            {{-- @foreach($book->reviews as $review)
                <div class="review">
                    <h5>{{ $review->user->name }} <small>({{ $review->created_at->format('Y-m-d') }})</small></h5>
                    <p>{{ $review->content }}</p>
                    <p><strong>التقييم:</strong> {{ $review->rating }} / 5</p>
                </div>
            @endforeach --}}
            <form action="{{-- route('reviews.store', $book->id) --}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">أضف تعليقك:</label>
                    <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="rating">تقييم:</label>
                    <select name="rating" id="rating " class="form-control" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">إرسال</button>
            </form>
        </div>

        <!-- قسم الكتب المقترحة -->
        <div class="fade-in suggestions">
            <h2>كتب مقترحة</h2>
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