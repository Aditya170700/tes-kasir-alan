<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-1 font-medium leading-5 text-white focus:outline-none focus:border-white-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-1 border-b-2 border-transparent font-medium leading-5 text-white-500 hover:text-white-700 hover:border-white-300 focus:outline-none focus:text-white-700 focus:border-white-300 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
