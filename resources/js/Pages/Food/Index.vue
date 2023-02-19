<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { useAttrs } from "@vue/runtime-core";

let attrs = useAttrs();
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
                                    class="py-5 text-center font-bold"
                                    style="width: 5%"
                                >
                                    #
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6 font-bold"
                                    style="width: 50%"
                                >
                                    Nama
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6 text-center font-bold"
                                    style="width: 20%"
                                >
                                    Foto
                                </th>
                                <th
                                    scope="col"
                                    class="py-5 px-6 font-bold"
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
                                v-for="(data, i) in attrs.results"
                                :key="i"
                            >
                                <td class="py-2 text-center">{{ i + 1 }}</td>
                                <td class="px-6 py-2">{{ data.nama }}</td>
                                <td class="px-6 py-2">
                                    <img
                                        :src="data.foto_url"
                                        :alt="data.nama"
                                        class="h-auto mx-auto"
                                        style="width: 50%"
                                    />
                                </td>
                                <td class="px-6 py-2">{{ data.idr_harga }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
