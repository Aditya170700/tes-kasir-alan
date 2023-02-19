<script setup>
import FormError from "@/Components/FormError.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

let form = useForm({
    changeBorder: false,
    fotoError: null,
    fotoPreview: null,
    fotoName: null,
    nama: "",
    foto: null,
    harga: 0,
    errors: null,
});

function onDragOver(e) {
    e.preventDefault();
    form.changeBorder = true;
}

function onDrop(e) {
    e.preventDefault();
    form.changeBorder = false;

    [...e.dataTransfer.items].forEach((item, i) => {
        if (item.kind === "file") {
            readerFoto(item.getAsFile());
        }
    });
}

function onDragLeave(e) {
    e.preventDefault();
    form.changeBorder = false;
}

function onClick(e) {
    document.getElementById("uploadFile").click();
}

function changeFile(e) {
    readerFoto(e.target.files[0]);
}

function readerFoto(file) {
    form.fotoError = null;

    if (!["png", "jpg", "jpeg", "webp"].includes(file.name.split(".").pop())) {
        form.fotoError = "Ekstensi harus png/jpg/jpeg/webp";
        return;
    }

    form.fotoName = file.name;
    const reader = new FileReader();
    reader.onload = (e) => {
        form.fotoPreview = e.target.result;
        form.foto = e.target.result.replace(/^data:image\/[a-z]+;base64,/, "");
    };
    reader.readAsDataURL(file);
}

function submit() {
    form.transform((data) => ({
        ...data,
    })).post(route("foods.store"));
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

                    <form @submit.prevent="submit">
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
                                v-model="form.nama"
                                required
                            />
                            <FormError
                                :message="form.errors?.nama"
                                v-if="form.errors?.nama"
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
                                    form.changeBorder ? 'border-sky-400' : ''
                                } ${form.fotoError ? 'border-red-500' : ''}`"
                                @drop="onDrop"
                                @dragover="onDragOver"
                                @dragleave="onDragLeave"
                                @click="onClick"
                            >
                                <i
                                    :class="`fas fa-cloud-arrow-up ${
                                        !form.fotoError
                                            ? 'text-gray-400'
                                            : 'text-red-500'
                                    }`"
                                ></i>
                                <p
                                    class="font-bold text-gray-400 text-sm"
                                    v-if="!form.fotoError && !form.fotoName"
                                >
                                    drag and drop a file here or click
                                </p>
                                <p
                                    class="font-bold text-red-500 text-sm"
                                    v-if="form.fotoError"
                                >
                                    {{ form.fotoError }}
                                </p>
                                <p
                                    class="font-bold text-gray-400 text-sm"
                                    v-if="form.fotoName"
                                >
                                    {{ form.fotoName }}
                                </p>
                            </div>
                            <FormError
                                :message="form.errors?.foto"
                                v-if="form.errors?.foto"
                            />
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
                                    type="number"
                                    id="harga"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-sky-400 focus:border-sky-400 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-400 dark:focus:border-sky-400 pl-14"
                                    v-model="form.harga"
                                    required
                                />
                            </div>
                            <FormError
                                :message="form.errors?.harga"
                                v-if="form.errors?.harga"
                            />
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
