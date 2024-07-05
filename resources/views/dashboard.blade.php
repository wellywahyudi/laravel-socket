<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>
                <div x-data="{ users: [], added: {}, userCount: 0 }" x-init="Echo.channel('user-registrations')
                    .listen('UserRegistrations', (e) => {
                        userCount += 1;
                        // Add the new user to the beginning of the array
                        users.unshift(e.user);
                
                        // Mark the user as newly added
                        added[e.user.id] = true;
                
                        // Keep only the latest 4 users
                        if (users.length > 4) {
                            users.pop();
                        }
                
                        // Remove the 'newly added' mark after a short delay
                        setTimeout(() => {
                            delete added[e.user.id];
                        }, 100); // Duration should match the transition duration
                    })">
                    <div class="mx-auto px-6 max-w-6xl text-gray-500">
                        <div class="relative">
                            <div class="relative z-10 grid gap-3 grid-cols-6">
                                <div
                                    class="col-span-full lg:col-span-2 overflow-hidden flex relative p-8 rounded-xl bg-white border border-gray-200 ">
                                    <div class="flex flex-col justify-between relative z-10 space-y-12 lg:space-y-6">
                                        <div
                                            class="relative aspect-square rounded-full size-12 flex border before:absolute before:-inset-2 before:border before:rounded-full">
                                            <svg class="size-6 m-auto" xmlns="http://www.w3.org/2000/svg" width="1em"
                                                height="1em" viewBox="0 0 24 24">
                                                <path fill="#212121" fill-rule="nonzero"
                                                    d="M5.99 4.929a.75.75 0 0 1 0 1.06 8.5 8.5 0 0 0 0 12.021.75.75 0 0 1-1.061 1.061c-3.905-3.905-3.905-10.237 0-14.142a.75.75 0 0 1 1.06 0Zm13.081 0c3.905 3.905 3.905 10.237 0 14.142a.75.75 0 0 1-1.06-1.06 8.5 8.5 0 0 0 0-12.021.75.75 0 0 1 1.06-1.061ZM8.818 7.757a.75.75 0 0 1 0 1.061 4.5 4.5 0 0 0 0 6.364.75.75 0 0 1-1.06 1.06 6 6 0 0 1 0-8.485.75.75 0 0 1 1.06 0Zm7.425 0a6 6 0 0 1 0 8.486.75.75 0 0 1-1.061-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 1.06-1.06ZM12 10.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                            </svg>
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400/20"></span>

                                        </div>
                                        <div class="space-y-2">
                                            <div class="relative h-24 w-56 flex items-start">
                                                <span x-text="userCount"
                                                    class="w-fit block text-5xl font-semibold text-transparent bg-clip-text bg-gradient-to-br from-blue-300 to-pink-600">
                                                </span>
                                            </div>
                                            <h2 class="mt-6 font-semibold text-gray-950  text-3xl">
                                                User Register
                                            </h2>
                                            <p class="text-gray-700">
                                                Realtime update registered user using websocket.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="col-span-full lg:col-span-4 overflow-hidden relative p-8 rounded-xl bg-white border border-gray-200">
                                    <!-- component -->
                                    <div class="flex p-2 bg-no-repeat">
                                        <div class="w-full h-96">
                                            <div class="flex flex-col space-y-2">
                                                <!-- Item -->
                                                <template x-for="user in users" :key="user.id">
                                                    <div :class="{
                                                        'transition transform ease-out duration-500 -translate-y-4 opacity-0': added[
                                                            user.id
                                                        ],
                                                        'transition transform ease-in duration-500 translate-y-0 opacity-100':
                                                            !added[user.id]
                                                    }"
                                                        class="flex justify-between py-4 px-4 bg-gradient-to-r from-rose-100/50 to-teal-100/50 rounded-2xl transition transform ease-out duration-500 translate-y-0 opacity-100">
                                                        <div class="flex items-center space-x-4">
                                                            <img :src="'https://ui-avatars.com/api/?name=' + user.name"
                                                                class="rounded-full h-14 w-14" alt="">
                                                            <div class="flex flex-col space-y-1">
                                                                <span x-text="user.name"
                                                                    class="font-bold text-black"></span>
                                                                <span x-text="user.email" class="text-sm"></span>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                                                            <span x-text="user.created_at"></span>
                                                        </div>
                                                    </div>
                                                    <!-- Item -->
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
