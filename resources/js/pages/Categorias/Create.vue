<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-extrabold mb-6 text-center text-blue-700 dark:text-blue-300">🆕 Crear Nueva Categoría</h1>

      <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4 border border-blue-100 dark:border-blue-900">
        <div class="mb-5">
          <label class="block text-gray-800 dark:text-gray-200 text-sm font-semibold mb-2" for="nombre">
            🏷️ Nombre de la categoría
          </label>
          <input
            v-model="form.nombre"
            class="shadow-sm border border-blue-200 dark:border-blue-700 rounded w-full py-2 px-3 text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
            id="nombre"
            type="text"
            placeholder="Ej. Tecnología"
            required
          />
        </div>

        <div class="mb-6">
          <label class="block text-gray-800 dark:text-gray-200 text-sm font-semibold mb-2" for="descripcion">
            📝 Descripción
          </label>
          <textarea
            v-model="form.descripcion"
            class="shadow-sm border border-blue-200 dark:border-blue-700 rounded w-full py-2 px-3 text-gray-800 dark:text-white bg-gray-50 dark:bg-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
            id="descripcion"
            rows="3"
            placeholder="Describe brevemente la categoría..."
          ></textarea>
        </div>

        <div class="flex items-center justify-between">
          <Link
            :href="route('categorias.index')"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition-colors duration-200 flex items-center gap-1"
          >
            🔙 Cancelar
          </Link>
          <button
            type="submit"
            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md transition ease-in-out duration-150"
            :disabled="form.processing"
          >
            💾 Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const form = useForm({
  nombre: '',
  descripcion: ''
});

const submit = () => {
  form.post(route('categorias.store'));
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
