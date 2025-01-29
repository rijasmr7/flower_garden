@extends('layout')

@section('title', 'Home')

@section('content')

<section class="bg-cover bg-center p-[100px] px-5 text-center text-white w-full h-[50vh]"
  style="background-image: url('/images/tanaphong-toochinda-EeQyB_Qq6og-unsplash.jpg');">
  
  <h1 class="text-[48px] mb-5">Explore Natural Beauty</h1>
  <a href="{{ route('plants') }}" class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded">Shop now</a>
</section>


<section class="welcome-section">
    <div class="container mx-auto">
        <p class="welcome-text">
            Welcome to Haala Flower Garden, your enchanting online oasis where nature's beauty blossoms.
            Dive into a curated collection of lush greenery and vibrant blooms that transform any space into a sanctuary.
            Whether you're a seasoned plant lover or just beginning your green journey, Haala Flower Garden offers a diverse range of plants, expert advice, and personalized care tips to help you cultivate your own garden of dreams.
            Let us bring the magic of nature to your doorstep.
        </p>
    </div>
</section>

<section class="py-10">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="category-card">
            <img src="{{ asset('images\Sign up.jpg') }}" alt="Indoor plants" class="category-image">
            <div class="category-content">
                <h2 class="category-title">Plants</h2>
                <a href="{{ route('plants') }}" class="category-button">Shop now</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('images\priscilla-du-preez-0byOuAKmAbg-unsplash.jpg') }}" alt="Pots" class="category-image">
            <div class="category-content">
                <h2 class="category-title">Pots</h2>
                <a href="{{ route('pots') }}" class="category-button">Shop now</a>
            </div>
        </div>
        <div class="category-card">
            <img src="{{ asset('images\sincerely-media-Agr1YTrzYPI-unsplash.jpg') }}" alt="Gardening" class="category-image">
            <div class="category-content">
                <h2 class="category-title">Gardening</h2>
                <a href="{{ route('gardening.form') }}" class="category-button">Apply</a>
            </div>
        </div>
    </div>
</section>
@endsection
