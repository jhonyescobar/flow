<template>
  <div class="container mx-auto px-4 py-10">
    <div class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-extrabold text-blue-800 mb-8 flex items-center gap-2">
        🐟 Crear Nuevo Producto
      </h1>

      <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow-lg rounded-xl px-8 pt-6 pb-8">
        <!-- Nombre -->
        <div class="mb-5">
          <label for="nombre" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">🏷️ Nombre</label>
          <input v-model="form.nombre" id="nombre" type="text" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow" />
        </div>

        <!-- Identificador -->
        <div class="mb-5">
          <label for="identificador" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">🔢 Identificador</label>
          <input v-model="form.identificador" id="identificador" type="text" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow" />
        </div>

        <!-- Descripción -->
        <div class="mb-5">
          <label for="descripcion" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">📝 Descripción</label>
          <textarea v-model="form.descripcion" id="descripcion" rows="3"
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow"></textarea>
        </div>

        <!-- Precio -->
        <div class="mb-5">
          <label for="precio" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">💰 Precio</label>
          <input v-model="form.precio" id="precio" type="number" min="0" step="0.01" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow" />
        </div>

        <!-- Stock -->
        <div class="mb-5">
          <label for="stock" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">📦 Stock</label>
          <input v-model="form.stock" id="stock" type="number" min="0" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow" />
        </div>

        <!-- Categoría -->
        <div class="mb-5">
          <label for="categoria_id" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">📂 Categoría</label>
          <select v-model="form.categoria_id" id="categoria_id" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow">
            <option value="">Seleccione una categoría</option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
              {{ categoria.nombre }}
            </option>
          </select>
        </div>

        <!-- Estado -->
        <div class="mb-6">
          <label for="estado" class="block text-sm font-bold text-gray-700 dark:text-gray-200 mb-1">⚙️ Estado</label>
          <select v-model="form.estado" id="estado" required
            class="w-full border border-blue-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow">
            <option :value="true">Activo</option>
            <option :value="false">Inactivo</option>
          </select>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-between">
          <Link
            :href="route('productos.index')"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full transition-all duration-200"
          >
            ❌ Cancelar
          </Link>
          <button
            type="submit"
            :disabled="form.processing"
            class="bg-gradient-to-r from-green-500 to-lime-500 hover:from-green-600 hover:to-lime-600 text-white font-bold py-2 px-6 rounded-full shadow-md transition-all duration-200"
          >
            ✅ Guardar
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
  categorias: Array
});

const form = useForm({
  nombre: '',
  identificador: '',
  descripcion: '',
  precio: '',
  stock: '',
  categoria_id: '',
  estado: true
});

const submit = () => {
  form.post(route('productos.store'));
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
