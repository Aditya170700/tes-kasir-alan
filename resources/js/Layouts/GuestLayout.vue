<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-sky-400 border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('foods.index')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-white"
                                    />
                                </Link>
                            </div>
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ml-3 sm:flex"
                            >
                                <NavLink
                                    :href="route('foods.index')"
                                    :active="true"
                                >
                                    Alan Resto
                                </NavLink>
                            </div>
                        </div>

                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                ></div>
            </nav>

            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-0 px-8">
                    <div class="grid grid-cols-12 text-center">
                        <Link
                            :href="route('foods.index')"
                            :class="`py-1 ${
                                route().current().includes('foods.')
                                    ? 'text-sky-400 border-b-2 border-sky-400'
                                    : ''
                            }`"
                            >Food</Link
                        >
                        <Link
                            :href="route('transactions.index')"
                            :class="`py-1 ${
                                route().current().includes('transactions.')
                                    ? 'text-sky-400 border-b-2 border-sky-400'
                                    : ''
                            }`"
                            >Transaksi</Link
                        >
                    </div>
                </div>
            </header>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
