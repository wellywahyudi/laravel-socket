<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section>
                <div x-data="{ users: [], added: {}, userCount: 0, showToast: false, toastMessage: '', toastUser: {} }" x-init="Echo.channel('user-registrations')
                    .listen('UserRegistrations', (e) => {
                        userCount += 1;
                        // Add the new user to the beginning of the array
                        users.unshift(e.user);
                
                        // Mark the user as newly added
                        added[e.user.id] = true;
                
                        // Show toast notification
                        toastUser = e.user;
                        toastMessage = `${e.user.name} has registered!`;
                        showToast = true;
                        setTimeout(() => showToast = false, 3000); // Hide after 3 seconds
                
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
                        <div x-show="showToast" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-full"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-full"
                            class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-sm p-4 text-gray-900 bg-gradient-to-r from-rose-100/50 to-teal-100/50 rounded-lg shadow-lg"
                            @click.away="showToast = false" role="alert">
                            <div class="flex items-center mb-3">
                                <span class="mb-1 text-sm font-semibold text-gray-900">New notification</span>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8"
                                    @click="showToast = false" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center">
                                <div class="relative inline-block shrink-0">
                                    <img class="w-12 h-12 rounded-full" :src="'https://ui-avatars.com/api/?name=N'"
                                        alt="User image" />
                                    <span
                                        class="absolute bottom-0 right-0 inline-flex items-center justify-center w-6 h-6 bg-blue-600 rounded-full">
                                        <svg class="w-3 h-3 text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" fill="currentColor">
                                            <path
                                                d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z"
                                                fill="currentColor" />
                                            <path
                                                d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="sr-only">Message icon</span>
                                    </span>
                                </div>
                                <div class="ms-3 text-sm font-normal">
                                    <div class="text-sm font-semibold text-gray-900" x-text="toastUser.name"></div>
                                    <div class="text-sm font-normal">has registered successfully.</div>
                                    <span class="text-xs font-medium text-blue-600">a few seconds ago</span>
                                </div>
                            </div>
                        </div>


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
