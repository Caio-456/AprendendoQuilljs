<script setup>
import { onMounted, reactive } from 'vue';
import Quill from 'quill';
import { nextTick } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    postagem: {
        type: Object,
        required: true,
    },
});

const postagem = ref({ ...props.postagem });
const page = usePage();
const successMessage = computed(() => page.props?.flash?.success ?? null);

function submitForm() {
    router.patch(route('postagem.update', props.postagem.id), postagem.value)
}

import Link from 'quill/formats/link';
  onMounted(() => {
    const descricaoContainer = document.getElementById('descricao');
  if (!descricaoContainer) return;

  const quill = new Quill('#descricao', {
    placeholder: "Insira a descrição aqui...",
    theme: 'snow'
  });

  // Define o conteúdo inicial com base em `postagem.descricao`
  quill.root.innerHTML = postagem.value.descricao;

  // Captura alterações e atualiza `postagem.descricao`
  quill.on('text-change', () => {
     nextTick(() => {
        postagem.value.descricao = quill.root.innerHTML;
     });
  });
});
</script>

<template>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <Head title="Editar Postagem" />
    <AuthenticatedLayout>
      <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Editar postagem</h2>
      </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div v-if="successMessage" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                            {{ successMessage }}
                        </div>

                        <form @submit.prevent="submitForm">
                            <div class="mb-4">
                                <label for="titulo" class="block mt-1 w-full">Título:</label>
                                <input type="text" v-model="postagem.titulo" id="titulo" required
                                    class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 
                                           focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 
                                           rounded-md shadow-sm">
                            </div>
                            <b><p>Descrição: </p></b>
                            <div id="descricao"></div>
                            
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Salvar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
