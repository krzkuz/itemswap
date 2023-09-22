<form action="/">
    <div class="flex  justify-center">
        <div class="flex flex-wrap lg:flex-no-wrap mt-2 w-1/2 rounded-lg">
            <input
                type="text"
                name="search"
                class="h-14 w-full lg:w-1/2 pl-5 rounded-lg z-0 mr-2 mb-2"
                placeholder="Search for items..."
            />
            <div class="relative mr-2 mb-2">
                <i class="fa-solid fa-location-dot absolute top-5 left-3"></i>
                <input
                    type="text"
                    name="location"
                    class="h-14 pl-8 w-full rounded-lg z-0"
                    placeholder="Location..."
                />

            </div>
            
            <button
                type="submit"
                class="px-5 py-1 hover:text-laravel bg-white rounded-lg mb-2"
            >
            <i class="fa-solid fa-magnifying-glass fa-2x"></i>
            </button>
        </div>
    </div>
    
</form>