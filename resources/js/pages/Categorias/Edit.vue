<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-6 flex items-center gap-2">
        📝 Editar Categoría
      </h1>

      <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow-lg rounded-xl px-8 pt-6 pb-8 mb-4">
        <div class="mb-5">
          <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="nombre">
            🏷️ Nombre
          </label>
          <input
            v-model="form.nombre"
            id="nombre"
            type="text"
            required
            class="shadow appearance-none border border-blue-300 rounded w-full py-2 px-3 text-gray-800 dark:text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
        </div>

        <div class="mb-6">
          <label class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2" for="descripcion">
            📋 Descripción
          </label>
          <textarea
            v-model="form.descripcion"
            id="descripcion"
            rows="3"
            class="shadow appearance-none border border-blue-300 rounded w-full py-2 px-3 text-gray-800 dark:text-gray-100 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-400"
          ></textarea>
        </div>

        <div class="flex items-center justify-between">
          <Link
            :href="route('categorias.index')"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition-all duration-200"
          >
            ❌ Cancelar
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-200"
          >
            💾 Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  categoria: Object
});

const form = useForm({
  nombre: props.categoria.nombre,
  descripcion: props.categoria.descripcion
});

const submit = () => {
  form.put(route('categorias.update', props.categoria.id));
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
