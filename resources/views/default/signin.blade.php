<x-default title="Sign in">
    <div class="bg-white px-6 py-8 rounded-md shadow-lg">
        <form id="signin-form">
            <div class="flex flex-col items-center">
                <p class="text-3xl">Sign in</p>
                <p class="text-sm text-gray-600">Log in your account</p>
            </div>
            <div id="validation-error" class="hidden bg-red-500 text-white p-2 rounded-md mt-5 w-80 flex justify-between">
                <p id="validation-message" class="text-sm mr-5"></p>
                <span>
                    <svg class="w-6 h-6 text-white-500 hover:text-gray-500 cursor-pointer"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>
            <div class="mt-4">
                <label for="email">Email</label>
                <input id="email" type="text" class="border border-gray-300 p-2 rounded-md mt-2 w-80 block">
                <p id="email-error" class="mt-1 text-sm text-red-500 hidden"></p>
            </div>
            <div class="mt-3">
                <label for="password">Password</label>
                <div>
                    <input id="password" type="password" class="border border-gray-300 p-2 w-80 rounded-md mt-2">
                </div>
                <div>
                    <p class="hidden text-red-500 text-sm mt-1" id="password-error"></p>
                </div>
            </div>
            <div class="mt-4 text-sm">
                <p>Don't have an account?
                    <a href="/signup" class="text-blue-700 hover:underline cursor-pointer">
                        Sign up
                    </a>
                </p>
            </div>
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-500 p-2 rounded-lg text-white hover:bg-blue-700">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</x-default>
