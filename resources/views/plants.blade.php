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
    <!-- All Plants Section -->
    <h2 class="text-3xl font-semibold mb-6">All Plants</h2>
    <div id="plants-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Loading message or empty container will be replaced with actual data -->
        <div class="text-center" id="loading">Loading plants...</div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetchPlants();
});

function fetchPlants() {
    const container = document.getElementById('plants-container');
    
    axios.get('http://127.0.0.1:8000/api/plants')   
        .then(response => {
            const plants = response.data;
            container.innerHTML = ''; 

            if (plants.length === 0) {
                container.innerHTML = '<div class="text-center">No plants found</div>';
                return;
            }

            plants.forEach(plant => {
                const isAvailable = plant.is_available === 1;
                const plantElement = `
                        <div class="border-2 w-[90%] bg-black-100 p-4 shadow-lg overflow-hidden relative transition-transform duration-300 transform hover:scale-105 hover:shadow-lg flex items-center justify-center text-center mx-auto">
                <a href="/plants/${plant.id}" class="flex flex-col items-center justify-center">
                    <img src="${plant.image ? '/storage/' + plant.image : '/images/placeholder.png'}" 
                        alt="${plant.name}" class="h-48 w-48 object-cover rounded-full mb-4"
                        onerror="this.onerror=null; this.src='/images/placeholder.png';">
                    <h3 class="text-xl font-semibold">${plant.name}</h3>
                    <p class="text-gray-600">Rs. ${plant.price}</p>
                    <p class="text-gray-600">${plant.size} size</p>
                    <p class="text-gray-600">${plant.leave_color} leaves</p>
                    <p class="${isAvailable ? 'text-green-500' : 'text-red-500'}">
                        ${isAvailable ? 'In stock' : 'Arrives soon'}
                    </p>
                </a>
            </div>

                `;
                container.insertAdjacentHTML('beforeend', plantElement);
            });
        })
        .catch(error => {
            console.error('Error fetching plants:', error);
            container.innerHTML = `
                <div class="text-center text-red-500">
                    Error loading plants. Please try again later.
                    <br>
                    ${error.message}
                </div>
            `;
        });
}

</script>
