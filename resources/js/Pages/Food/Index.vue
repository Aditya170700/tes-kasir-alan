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
                <p class="text-gray-400 mb-3">
                    Tambahkan menu makanan yang ada di resto
                </p>
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-6"
                >
                    <Link
                        :href="route('foods.create')"
                        class="rounded-sm bg-sky-400 px-4 py-1 text-white shadow-lg"
                    >
                        <i class="fas fa-plus mr-2"></i>Tambah Menu
                    </Link>
                    <table class="table-auto w-full text-sm text-left mt-10">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-100"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="py-5 text-center"
                                    style="width: 5%"
                                >
                                    #
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6"
                                    style="width: 50%"
                                >
                                    Nama
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6 text-center"
                                    style="width: 20%"
                                >
                                    Foto
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6"
                                    style="width: 25%"
                                >
                                    Harga
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                :class="`${
                                    i % 2 != 0 ? 'bg-white' : 'bg-gray-50'
                                } hover:bg-gray-100`"
                                v-for="i in 10"
                                :key="i"
                            >
                                <td class="py-2 text-center">{{ i }}</td>
                                <td class="px-6 py-2">Sate Ayam</td>
                                <td class="px-6 py-2">
                                    <img
                                        src="https://kbu-cdn.com/dk/wp-content/uploads/sate-ayam.jpg"
                                        alt="Sate Ayam"
                                        class="h-auto mx-auto"
                                        style="width: 50%"
                                    />
                                </td>
                                <td class="px-6 py-2">Rp. 30.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
