<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { reactive } from "@vue/reactivity";

let data = reactive({
    changeBorder: false,
    fotoError: null,
    fotoPreview: null,
    fotoName: null,
    nama: "",
    foto: null,
    harga: 0,
});

function onDragOver(e) {
    e.preventDefault();
    data.changeBorder = true;
}

function onDrop(e) {
    e.preventDefault();
    data.changeBorder = false;

    [...e.dataTransfer.items].forEach((item, i) => {
        if (item.kind === "file") {
            readerFoto(item.getAsFile());
        }
    });
}

function onDragLeave(e) {
    e.preventDefault();
    data.changeBorder = false;
}

function onClick(e) {
    document.getElementById("uploadFile").click();
}

function changeFile(e) {
    readerFoto(e.target.files[0]);
}

function readerFoto(file) {
    data.fotoError = null;

    if (!["png", "jpg", "jpeg", "webp"].includes(file.name.split(".").pop())) {
        data.fotoError = "Ekstensi harus png/jpg/jpeg/webp";
        return;
    }

    data.fotoName = file.name;
    const reader = new FileReader();
    reader.onload = (e) => {
        data.fotoPreview = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>

<template>
    <Head title="Create Food" />

    <GuestLayout>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-sm p-6"
                >
                    <p class="text-sky-400 font-bold mb-10">Tambahkan Menu</p>

                    <form>
                        <div class="mb-6">
                            <label
                                for="nama"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white"
                                >Nama Menu</label
                            >
                            <input
                                type="text"
                                id="nama"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-sky-400 focus:border-sky-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-400 dark:focus:border-sky-400"
                                required
                            />
                        </div>
                        <div class="mb-6">
                            <label
                                for="foto"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white"
                                >Foto</label
                            >
                            <input
                                id="uploadFile"
                                type="file"
                                @change="changeFile"
                                hidden
                            />
                            <div
                                :class="`p-6 bg-gray-50 border rounded-sm dark:bg-gray-800 dark:border-gray-700 text-center hover:bg-gray-100 cursor-pointer hover:border-sky-400 ${
                                    data.changeBorder ? 'border-sky-400' : ''
                                } ${data.fotoError ? 'border-red-500' : ''}`"
                                @drop="onDrop"
                                @dragover="onDragOver"
                                @dragleave="onDragLeave"
                                @click="onClick"
                            >
                                <i
                                    :class="`fas fa-cloud-arrow-up ${
                                        !data.fotoError
                                            ? 'text-gray-400'
                                            : 'text-red-500'
                                    }`"
                                ></i>
                                <p
                                    class="font-bold text-gray-400 text-sm"
                                    v-if="!data.fotoError && !data.fotoName"
                                >
                                    drag and drop a file here or click
                                </p>
                                <p
                                    class="font-bold text-red-500 text-sm"
                                    v-if="data.fotoError"
                                >
                                    {{ data.fotoError }}
                                </p>
                                <p
                                    class="font-bold text-gray-400 text-sm"
                                    v-if="data.fotoName"
                                >
                                    {{ data.fotoName }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label
                                for="harga"
                                class="block mb-2 text-sm font-medium text-gray-400 dark:text-white"
                                >Harga</label
                            >
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center text-center pointer-events-none bg-sky-400 px-3 text-white"
                                >
                                    RP.
                                </div>
                                <input
                                    type="text"
                                    id="harga"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-sky-400 focus:border-sky-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-400 dark:focus:border-sky-400"
                                    required
                                />
                            </div>
                        </div>
                        <div class="text-right">
                            <button
                                type="submit"
                                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-bold rounded-sm text-sm w-full sm:w-auto px-12 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
