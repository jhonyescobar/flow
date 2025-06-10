<template>
  <div class="max-w-7xl mx-auto px-6 py-10">
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">📦 Lista de Productos</h1>
      <Link
        :href="route('productos.create')"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow transition"
      >
        + Crear Producto
      </Link>
    </div>

    <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Identificador</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Precio</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Stock</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-100 dark:divide-gray-800">
            <tr v-for="producto in productos.data" :key="producto.id" class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ producto.nombre }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ producto.identificador }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ producto.categoria?.nombre }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ producto.precio }} Bs</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-white">{{ producto.stock }}</td>
              <td class="px-6 py-4">
                <span
                  :class="producto.estado
                    ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                    : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'"
                  class="px-3 py-1 text-xs font-semibold rounded-full"
                >
                  {{ producto.estado ? 'Activo' : 'Inactivo' }}
                </span>
              </td>
              <td class="px-6 py-4 flex gap-3 items-center text-sm">
                <Link :href="route('productos.show', producto.id)" class="text-blue-600 hover:text-blue-400" title="Ver">
                  <Eye class="w-5 h-5" />
                </Link>
                <Link :href="route('productos.edit', producto.id)" class="text-indigo-500 hover:text-indigo-300" title="Editar">
                  <Pencil class="w-5 h-5" />
                </Link>
                <button @click="confirmDelete(producto)" class="text-red-600 hover:text-red-400" title="Eliminar">
                  <Trash2 class="w-5 h-5" />
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-6">
      <Pagination :links="productos.links" />
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Trash2, Pencil, Eye } from 'lucide-vue-next';

defineProps({
  productos: Object
});

const confirmDelete = (producto) => {
  if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
    router.delete(route('productos.destroy', producto.id));
  }
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
