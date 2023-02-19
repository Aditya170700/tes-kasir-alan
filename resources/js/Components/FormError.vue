<template>
    <p class="mt-2 text-sm text-red-500">{{ message }}</p>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true,
        },
    },
    setup() {
        //
    },
};
</script>
