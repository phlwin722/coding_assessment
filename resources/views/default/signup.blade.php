<x-default title="Sign up">
    <div class="bg-white shadow-lg py-8 px-6 rounded-md">
        <form id="signup-form">
            <div class="flex flex-col items-center">
                <p class="text-2xl">Sign up</p>
                <p class="text-sm text-gray-600">Create your account</p>
            </div>
            <div class="mt-3">
                <label for="first-name">First name</label>
                <input
                    type="text"
                    id="first-name"
                    class="border border-gray-300 w-80 p-2 mt-2 rounded-md  block"
                    >
                <p class="mt-1 text-sm text-red-500" id="firstname-error"></p>
            </div>
            <div class="mt-3">
                <label for="last-name">Last name</label>
                <input
                    type="text"
                    id="last-name"
                    class="border border-gray-300 w-80 p-2 mt-2 rounded-md  block"
                    >
                <p id="lastname-error" class="mt-1 text-red-500 text-sm"></p>
            </div>
            <div class="mt-3">
                <label for="email">Email</label>
                <input
                    type="text"
                    id="email"
                    class="border border-gray-300 w-80 p-2 mt-2 rounded-md  block"
                    >
                <p id="email-error" class="mt-1 text-red-500 text-sm"></p>
            </div>
            <div class="mt-3">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    class="border border-gray-300 w-80 p-2 mt-2 rounded-md  block"
                    >
                    <p id="password-error" class="mt-1 text-sm text-red-500 w-80"></p>
            </div>
            <div class="mt-3 text-sm">
                <p>Already have an account?
                    <a href="/signin" class="text-blue-700 hover:underline cursor-pointer">
                        Sign in
                    </a>
                </p>
            </div>
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-700">
                    Sign up
                </button>
            </div>
        </form>
    </div>
</x-default>