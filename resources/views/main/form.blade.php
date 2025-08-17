<x-main title="form">
    <div class="p-4">
        <div class="bg-white p-4 rounded-md">
            <h1 class="text-3xl font-semibold">Form</h1>
            <div class="mt-5">
                <form id="movie-form">
                    <div class="mt-2">
                        <label for="">Title</label>
                        <input id="title" type="text"
                            class="w-90 p-2 mt-1 rounded-md block border border-gray-300">
                        <p id="title-error" class="mt-1 text-red-500 text-sm hidden"></p>
                    </div>
                    <div class="mt-2">
                        <label for="description">Description</label>
                        <textarea name="" id="description" class="p-2 border block mt-1 border-gray-300 w-90"></textarea>
                        <p id="description-error" class="mt-1 text-red-500 text-sm hidden"></p>
                    </div>
                    <div class="mt-2">
                        <label for="price">Price</label>
                        <input type="number" id="price"
                            class="w-90 p-2 mt-1 rounded-md block border border-gray-300">
                        <p id="price-error" class="mt-1 text-red-500 text-sm hidden"></p>
                    </div>
                    <div class="mt-2">
                        <label for="date">Release date</label>
                        <input type="date" id="date"
                            class="w-90 p-2 mt-1 rounded-md block border border-gray-300">
                        <p id="date-error" class="mt-1 text-red-500 text-sm hidden"></p>
                    </div>

                    <div class="mt-5">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 py-2 px-5 text-white rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main>
