<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import FormError from "@/Components/FormError.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref, useAttrs } from "@vue/runtime-core";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { toast } from "@/utils";

let attrs = useAttrs();
let form = useForm({
    foods: [],
    total: 0,
    charge: false,
    bayar: 0,
    kembalian: 0,
    showKembalian: false,
});

function rupiah(number) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(number);
}

function addProduct(data) {
    let temp = {
        id: data.id,
        nama: data.nama,
        harga: data.harga,
        foto_url: data.foto_url,
        qty: 1,
    };

    if (form.foods?.length == 0) {
        form.foods.push(temp);
    } else {
        let exists = false;
        form.foods.forEach((val, i) => {
            if (val.id == temp.id) {
                val.qty += 1;
                exists = true;
            }
        });

        if (!exists) {
            form.foods.push(temp);
        }
    }

    form.total += temp.harga;
}

function clearProduct() {
    form.foods = [];
    form.total = 0;
}

function charge() {
    form.showKembalian = false;
    form.charge = true;
    form.kembalian = 0;
    form.bayar = 0;
}

function pay() {
    form.showKembalian = true;
    form.kembalian = form.bayar - form.total;
}

function save() {
    form.foods = [];
    form.total = 0;
    form.charge = false;
    toast("Transaksi disimpan");
}
</script>

<template>
    <Head title="Transaksi" />
    <GuestLayout>
        <TransitionRoot as="template" :show="form.charge">
            <Dialog as="div" class="relative z-10" @close="form.charge = false">
                <TransitionChild
                    as="template"
                    enter="ease-out duration-300"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in duration-200"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div
                        class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"
                    />
                </TransitionChild>

                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div
                        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                    >
                        <TransitionChild
                            as="template"
                            enter="ease-out duration-300"
                            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            enter-to="opacity-100 translate-y-0 sm:scale-100"
                            leave="ease-in duration-200"
                            leave-from="opacity-100 translate-y-0 sm:scale-100"
                            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        >
                            <DialogPanel
                                class="relative transform overflow-hidden rounded-sm bg-white text-left shadow-xl transition-all w-full max-w-5xl"
                            >
                                <div class="bg-white p-10">
                                    <h1
                                        class="align-middle font-bold text-xl mb-3"
                                    >
                                        Detail Pesanan
                                    </h1>
                                    <div class="grid grid-cols-12 gap-12">
                                        <div class="col-span-8">
                                            <table
                                                class="table-auto w-full text-sm text-left"
                                            >
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
                                                            style="width: 35%"
                                                        >
                                                            Nama
                                                        </th>
                                                        <th
                                                            scope="col"
                                                            class="py-5 px-6 text-center font-bold"
                                                            style="width: 35%"
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
                                                            i % 2 != 0
                                                                ? 'bg-white'
                                                                : 'bg-gray-50'
                                                        } hover:bg-gray-100`"
                                                        v-for="(
                                                            data, i
                                                        ) in form.foods"
                                                        :key="i"
                                                    >
                                                        <td
                                                            class="py-2 text-center"
                                                        >
                                                            {{ i + 1 }}
                                                        </td>
                                                        <td class="px-6 py-2">
                                                            {{ data.nama }}
                                                        </td>
                                                        <td class="px-6 py-2">
                                                            <img
                                                                :src="
                                                                    data.foto_url
                                                                "
                                                                :alt="data.nama"
                                                                class="h-auto mx-auto"
                                                                style="
                                                                    width: 50%;
                                                                "
                                                            />
                                                        </td>
                                                        <td class="px-6 py-2">
                                                            {{
                                                                rupiah(
                                                                    data.harga
                                                                )
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-span-4">
                                            <h1
                                                class="text-center align-middle font-bold text-sm mb-3"
                                            >
                                                Uang Pembeli (Rp)
                                            </h1>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="col-span-2">
                                                    <input
                                                        type="number"
                                                        :class="`bg-white border border-gray-300 text-gray-900 text-sm rounded-sm ${
                                                            form.bayar <
                                                            form.total
                                                                ? 'focus:ring-red-500 focus:border-red-500'
                                                                : 'focus:ring-sky-400 focus:border-sky-400'
                                                        } block w-full p-2.5`"
                                                        v-model="form.bayar"
                                                    />
                                                    <FormError
                                                        message="Uang tidak cukup"
                                                        v-if="
                                                            form.bayar <
                                                            form.total
                                                        "
                                                    />
                                                </div>
                                                <div class="">
                                                    <button
                                                        class="border border-gray-300 w-full py-1 hover:bg-red-500 hover:text-white"
                                                        type="button"
                                                        @click="
                                                            form.charge = false
                                                        "
                                                    >
                                                        Close
                                                    </button>
                                                </div>
                                                <div class="">
                                                    <button
                                                        class="border border-sky-400 bg-sky-400 w-full py-1 hover:bg-sky-500 text-white"
                                                        type="button"
                                                        @click="pay"
                                                    >
                                                        Pay!
                                                    </button>
                                                </div>
                                                <div
                                                    class="col-span-2"
                                                    v-if="form.showKembalian"
                                                >
                                                    <p
                                                        class="text-red-500 font-bold"
                                                    >
                                                        Kembalian :
                                                        {{
                                                            rupiah(
                                                                form.kembalian
                                                            )
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-12 gap-12">
                    <div class="col-span-8">
                        <div class="grid grid-cols-3 gap-12">
                            <div
                                class="bg-white rounded-sm shadow-md dark:bg-gray-800 dark:border-gray-700 hover:opacity-80"
                                v-for="(data, i) in attrs.foods"
                                :key="i"
                                @click="addProduct(data)"
                            >
                                <a href="#">
                                    <img
                                        class="rounded-t-sm"
                                        :src="data.foto_url"
                                        :alt="data.nama"
                                    />
                                </a>
                                <div class="p-5">
                                    <p
                                        class="font-bold text-gray-700 dark:text-gray-400 text-center"
                                    >
                                        {{ data.nama }}
                                    </p>
                                    <p
                                        class="font-bold text-sky-400 dark:text-gray-400 text-center"
                                    >
                                        {{ data.idr_harga }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div
                            class="bg-white rounded-sm shadow-md dark:bg-gray-800 dark:border-gray-700 p-5"
                        >
                            <div class="text-center mb-5 text-sky-400">
                                <i
                                    class="fas fa-user-circle fa-2x align-middle mr-2"
                                ></i>
                                <span class="align-middle font-bold text-xl"
                                    >Pesanan</span
                                >
                            </div>
                            <div
                                class="grid grid-rows-1 gap-4 mb-4"
                                v-if="form.foods?.length > 0"
                            >
                                <div
                                    class="grid grid-cols-12 gap-2"
                                    v-for="(data, i) in form.foods"
                                    :key="i"
                                >
                                    <div class="col-span-4">
                                        <img
                                            :src="data.foto_url"
                                            :alt="data.nama"
                                        />
                                    </div>
                                    <div class="col-span-3 text-sm my-auto">
                                        {{ data.nama }}
                                    </div>
                                    <div class="text-sm my-auto">
                                        x{{ data.qty }}
                                    </div>
                                    <div
                                        class="col-span-4 text-sm font-bold text-sky-400 my-auto"
                                    >
                                        {{ rupiah(data.harga * data.qty) }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 gap-2">
                                    <button
                                        class="border border-red-500 rounded-sm text-red-500 text-sm font-bold py-1 hover:bg-red-500 hover:text-white"
                                        @click="clearProduct"
                                    >
                                        Clear Cart
                                    </button>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <button
                                        class="border border-green-700 bg-green-700 rounded-sm text-white text-sm font-bold py-1"
                                        @click="save"
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
                                        @click="charge"
                                    >
                                        Charge {{ rupiah(form.total) }}
                                    </button>
                                </div>
                            </div>
                            <div class="grid grid-rows-1 gap-4 mb-4" v-else>
                                <p class="text-center text-red-500">
                                    Belum ada produk dipilih
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
