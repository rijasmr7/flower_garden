<div>
    <div class="flex justify-center items-center space-x-20">
        <h1 class="dark:text-white m-10 text-3xl font-semibold">Plants</h1>
    </div>

    <div class="flex justify-center items-center space-x-20">
        <div id="plants-container" class="grid grid-cols-1 md:grid-cols-3 md:gap-16">
            <div class="text-center" id="loading">Loading plants...</div>
        </div>
    </div>
</div>

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
                    <a href="/plant/${plant.id}" class="${isAvailable ? '' : 'opacity-50 pointer-events-none'}">
                        <div class="p-4">
                            <div class="h-[200px] w-[200px] cursor-pointer rounded-full m-2 bg-white overflow-hidden flex justify-center items-center transform transition-transform duration-300 hover:scale-110 hover:shadow-lg">
                                <img class="object-contain h-full w-full" src="${plant.image}" alt="${plant.name}"
                                    onerror="this.onerror=null; this.src='/images/placeholder.png';">
                            </div>
                            <p class="text-center dark:text-white font-semibold">${plant.name}</p>
                            <p class="text-center text-gray-500">${plant.category} - ${plant.size}</p>
                            <p class="text-center text-green-600 font-bold">$${plant.price.toFixed(2)}</p>
                        </div>
                    </a>
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
