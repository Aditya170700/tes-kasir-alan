<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Food" />
    <GuestLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-12">
                    <div class="col-span-8">
                        <div class="grid grid-cols-3 gap-12">
                            <div
                                class="bg-white rounded-sm shadow-md dark:bg-gray-800 dark:border-gray-700"
                                v-for="i in 7"
                                :key="i"
                            >
                                <a href="#">
                                    <img
                                        class="rounded-t-sm"
                                        src="https://kbu-cdn.com/dk/wp-content/uploads/sate-ayam.jpg"
                                        alt="Sate Ayam"
                                    />
                                </a>
                                <div class="p-5">
                                    <p
                                        class="font-bold text-gray-700 dark:text-gray-400 text-center"
                                    >
                                        Sate Ayam
                                    </p>
                                    <p
                                        class="font-bold text-sky-400 dark:text-gray-400 text-center"
                                    >
                                        Rp. 30.000
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div
                            class="bg-white rounded-sm shadow-md dark:bg-gray-800 dark:border-gray-700 p-5"
                        >
                            <div class="text-center mb-5">
                                <i
                                    class="fas fa-user-circle fa-2x align-middle mr-2"
                                ></i>
                                <span class="align-middle font-bold text-xl"
                                    >Pesanan</span
                                >
                            </div>
                            <div class="grid grid-rows-1 gap-4 mb-4">
                                <div
                                    class="grid grid-cols-12 gap-2"
                                    v-for="i in 4"
                                    :key="i"
                                >
                                    <div class="col-span-4">
                                        <img
                                            src="https://kbu-cdn.com/dk/wp-content/uploads/sate-ayam.jpg"
                                            alt=""
                                        />
                                    </div>
                                    <div class="col-span-4 text-sm my-auto">
                                        Sate Ayam
                                    </div>
                                    <div class="text-sm my-auto">x1</div>
                                    <div
                                        class="col-span-3 text-sm font-bold text-sky-400 my-auto"
                                    >
                                        Rp. 30.000
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2">
                                    <button
                                        class="border border-red-500 rounded-sm text-red-500 text-sm font-bold py-1"
                                    >
                                        Clear Cart
                                    </button>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <button
                                        class="border border-green-700 bg-green-700 rounded-sm text-white text-sm font-bold py-1"
                                    >
                                        Save Bill
                                    </button>
                                    <button
                                        class="border border-green-700 bg-green-700 rounded-sm text-white text-sm font-bold py-1"
                                    >
                                        Print Bill
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 gap-2">
                                    <button
                                        class="border border-sky-400 bg-sky-400 rounded-sm text-white text-sm font-bold py-1"
                                    >
                                        Charge Rp. 30.000
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
