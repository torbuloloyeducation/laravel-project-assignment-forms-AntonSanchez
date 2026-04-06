<x-layout>

    @if(session('success'))
        <p class="text-green-400 p-3">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p class="text-red-400 p-3">{{ session('error') }}</p>
    @endif

    @error('email')
        <p class="text-red-400 p-3">{{ $message }}</p>
    @enderror

    <form method="POST" action="/formtest">
        @csrf

        <div class="space-y-12">
            <div class="border-b border-white/10">
                <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 p-10 bg-gray-800 rounded-lg">

                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium text-white">Email</label>

                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white/5 pl-3 outline-1 outline-white/10 focus-within:outline-2 focus-within:outline-indigo-500">
                                <input id="email" type="email" name="email"
                                    placeholder="juandelacruz@umindanao.edu.ph"
                                    class="block w-full bg-transparent py-1.5 text-white placeholder:text-gray-500 focus:outline-none" />
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <button type="submit"
                                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white">
                                Save
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <div class="mt-5 p-5 bg-gray-800 rounded-lg">
        <h2 class="text-lg font-semibold text-white mb-3">Emails</h2>

        <ul>
            @foreach ($emails as $index => $email)
                <li class="text-sm p-2 flex justify-between items-center text-white border-b border-gray-700">

                    <span>{{ $email }}</span>

                    <form method="POST" action="/formtest/delete/{{ $index }}">
                        @csrf
                        <button class="text-red-400 text-xs">Delete</button>
                    </form>

                </li>
            @endforeach
        </ul>
    </div>

</x-layout>