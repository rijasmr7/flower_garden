@extends('layout')

@section('title', 'Plants')

@section('content')
<section class="bg-cover bg-center p-[100px] px-5 text-center text-white w-full h-[50vh]"
  style="background-image: url('images/erol-ahmed-IHL-Jbawvvo-unsplash.jpg');">
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

<div class="container mx-auto py-8">
    <!-- Indoor Plants Section -->
    <h2 class="text-3xl font-semibold mb-6">Indoor plants</h2>
    <div class="flex space-x-4 overflow-x-auto">
        @forelse($indoorPlants as $plant)
            <div class="border-2 w-64 flex-shrink-0 bg-white rounded-lg p-4 shadow-lg overflow-hidden relative transition-transform duration-300 transform hover:scale-105 hover:shadow-lg">
                <a href="{{ route('plants.show', $plant->id) }}">
                    <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" class="h-48 w-full object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold">{{ $plant->name }}</h3>
                    <p class="text-gray-600">Rs. {{ $plant->price }}</p>
                    <p class="text-gray-600">{{ ucfirst($plant->size) }} size</p>
                    <p class="text-gray-600">{{ $plant->leave_color }} leaves</p>
                    <p class="{{ $plant->is_available ? 'text-green-500' : 'text-red-500' }}">
                        {{ $plant->is_available ? 'In stock' : 'Arrives soon' }}
                    </p>
                </a>
            </div>
        @empty
            <p>No indoor plants available at the moment.</p>
        @endforelse
    </div>

    @include('plantsApi')
    <!-- Outdoor Plants Section -->
    <h2 class="text-3xl font-semibold my-6">Outdoor plants</h2>
    <div class="flex space-x-4 overflow-x-auto">
        @forelse($outdoorPlants as $plant)
            <div class="border-2 w-64 flex-shrink-0 bg-white rounded-lg p-4 shadow-lg overflow-hidden relative transition-transform duration-300 transform hover:scale-105 hover:shadow-lg">
                <a href="{{ route('plants.show', $plant->id) }}">
                    <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" class="h-48 w-full object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-semibold">{{ $plant->name }}</h3>
                    <p class="text-gray-600">Rs. {{ $plant->price }}</p>
                    <p class="text-gray-600">{{ ucfirst($plant->size) }} size</p>
                    <p class="text-gray-600">{{ $plant->leave_color }} leaves</p>
                    <p class="{{ $plant->is_available ? 'text-green-500' : 'text-red-500' }}">
                        {{ $plant->is_available ? 'In stock' : 'Arrives soon' }}
                    </p>
                </a>
            </div>
        @empty
            <p>No outdoor plants available at the moment.</p>
        @endforelse
    </div>
</div>
@endsection