@extends('layout')

@section('title', 'Pots')

@section('content')
<section class="bg-cover bg-center p-[100px] px-5 text-center text-white w-full h-[50vh]"
    style="background-image: url('images/erol-ahmed-IHL-Jbawvvo-unsplash.jpg');">
</section>

<section class="welcome-section">
    <div class="container mx-auto">
        <p class="welcome-text">
            Explore our stunning collection of pots designed to complement your plants perfectly.
            Whether you're looking for classic ceramic, modern minimalist, or rustic handcrafted pots, 
            Haala Flower Garden has something to suit every style. Bring elegance to your home or garden today!
        </p>
    </div>
</section>

<div class="container mx-auto py-8">
    <!-- All Pots Section -->
    <h2 class="text-3xl font-semibold mb-6">All Pots</h2>
    <div id="pots-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Loading message or empty container will be replaced with actual data -->
        <div class="text-center" id="loading">Loading pots...</div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchPots();
});

function fetchPots() {
    const container = document.getElementById('pots-container');
    
    axios.get('http://127.0.0.1:8000/api/pots')
        .then(response => {
            const pots = response.data;
            container.innerHTML = ''; 

            if (pots.length === 0) {
                container.innerHTML = '<div class="text-center">No pots found</div>';
                return;
            }

            pots.forEach(pot => {
                const isAvailable = pot.is_available === 1;
                const potElement = `
                        <div class="border-2 w-[90%] bg-black-100 p-4 shadow-lg overflow-hidden relative transition-transform duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center text-center mx-auto">
                <a href="/pots/${pot.id}" class="flex flex-col items-center justify-center">
                    <img src="${pot.image ? '/storage/' + pot.image : '/images/placeholder.png'}" 
                        alt="${pot.name}" class="h-48 w-48 object-cover rounded-full mb-4"
                        onerror="this.onerror=null; this.src='/images/placeholder.png';">
                    <h3 class="text-xl font-semibold">${pot.name}</h3>
                    <p class="text-gray-600">Rs. ${pot.price}</p>
                    <p class="text-gray-600">${pot.material} material</p>
                    <p class="text-gray-600">${pot.size} size</p>
                    <p class="${isAvailable ? 'text-green-500' : 'text-red-500'}">
                        ${isAvailable ? 'In stock' : 'Arrives soon'}
                    </p>
                </a>
            </div>
                `;
                container.insertAdjacentHTML('beforeend', potElement);
            });
        })
        .catch(error => {
            console.error('Error fetching pots:', error);
            container.innerHTML = `
                <div class="text-center text-red-500">
                    Error loading pots. Please try again later.
                    <br>
                    ${error.message}
                </div>
            `;
        });
}
</script>
