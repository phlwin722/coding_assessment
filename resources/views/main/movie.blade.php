<x-main title="Movie">
    <div class="p-3">
        <div>
            <p class="text-2xl font-semibold">Movie</p>
        </div>

        <div class="mt-5 flex justify-end bg-white rounded-md p-2 shadow-lg">
            <button id="add-form" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                add
            </button>
        </div>

        <div class="mt-4 bg-white shadow-lg p-2">
            <table class="min-w-full table-auto text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-4">Title</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 divide-y divide-gray-200">

                </tbody>
            </table>
        </div>
    </div>
</x-main>