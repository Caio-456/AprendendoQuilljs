<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';

const form = reactive({
    titulo: '',
    descricao: ''
});

function submitForm() {
    const payload = new FormData();
    payload.append('titulo', form.titulo);
    payload.append('descricao', form.descricao);
    router.post(route('postagem.store'), payload);
}
</script>

<template>
  <Head title="Criar postagem" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Criar postagem</h2>
    </template>

<!-- Formulário de Criação -->
    <form @submit.prevent="submitForm" enctype="multipart/form-data">
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
              <!-- titulo -->
              <div class="mb-4">
                <label for="titulo" class="block font-medium">Título</label>
                <input id="titulo" v-model="form.titulo" type="text" required class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" />
              </div>

              <!-- Descrição -->
              <div class="mb-4">
                <label for="descricao" class="block font-medium">Descrição</label>
                <input id="descricao" v-model="form.descricao" type="text" required class="mt-1 block w-full border-gray-300 dark:bg-gray-700 dark:text-white rounded-md shadow-sm" />
              </div>
              <!-- Botão de Envio -->
              <div class="mt-6">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"> Postar </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </AuthenticatedLayout>
</template>