<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

<Head title="Dashboard" />
    <AuthenticatedLayout>

        <!-- Header -->
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>
        <!-- Conteúdo -->
        <center><b><h1>Aqui vai mostrar as postagens depois</h1></b></center>
    </AuthenticatedLayout>
</template>
