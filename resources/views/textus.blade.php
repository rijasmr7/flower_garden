@extends('layout')

@section('title', 'Text Us')

@section('content')
<div class="container mx-auto py-8 flex space-x-8">
    
    <div class="w-full lg:w-1/2 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-green-600">Contact Us</h2>
        <p class="mb-4">If you have any inquiries or feedback, please fill out the form below:</p>
        
        <form action="{{ route('textus.send') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                </div>
                <div>
                    <label for="phone" class="block text-lg font-medium text-gray-700">Phone</label>
                    <input type="tel" name="phone" id="phone" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                </div>
                <div>
                    <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required>
                </div>
            </div>
            <div class="mt-4">
                <label for="message" class="block text-lg font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="mt-1 block w-full p-3 rounded-md border border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" required></textarea>
            </div><br>
            @if (Auth::check())
            <button type="submit" class="w-full bg-green-600 text-white font-semibold py-3 rounded-md hover:bg-green-700 transition ease-in-out duration-300">Send</button>
            @else
                <p class="text-red-500 mt-4">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or <a href="{{ route('register') }}" class="text-blue-500">register</a> to make inquiry.</p>
            @endif
        </form>
    </div>

    
    <div class="w-full lg:w-1/2 bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-green-600">Why Contact Us?</h2>
    
        <h3 class="text-xl font-semibold">Convenient Communication</h3>
        <p>💬 Our Text Us page provides a quick and easy way for you to reach out with any questions or feedback.</p>
    
        <h3 class="text-xl font-semibold mt-4">Personalized Recommendations</h3>
        <p>🌱 Inquire about specific plants, pots, or gardening services, and receive personalized recommendations tailored to your needs.</p>
    
        <h3 class="text-xl font-semibold mt-4">Feedback and Suggestions</h3>
        <p>📝 We value your thoughts on your shopping experience. Share your feedback and suggestions to help us enhance our services.</p>
    
        <h3 class="text-xl font-semibold mt-4">Inquiries Made Easy</h3>
        <p>⏰ Easily inquire about orders, availability, or services without needing to visit the store or make a phone call.</p>
    
        <h3 class="text-xl font-semibold mt-4">Stay Updated</h3>
        <p>🔔 Receive updates and responses from our admin regarding your inquiries, fostering a sense of connection and community.</p>
    </div>

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
