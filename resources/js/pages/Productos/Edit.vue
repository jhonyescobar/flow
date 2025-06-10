<template>
  <div class="max-w-3xl mx-auto px-6 py-10 bg-white shadow-xl rounded-2xl border border-gray-200">
    <h2 class="text-3xl font-semibold text-gray-800 mb-8 text-center">✏️ Editar Producto</h2>

    <form @submit.prevent="submit" class="space-y-6">
      <div>
        <label for="nombre" class="block text-gray-700 text-sm font-medium mb-1">Nombre</label>
        <input
          v-model="form.nombre"
          id="nombre"
          type="text"
          required
          class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
        />
      </div>

      <div>
        <label for="identificador" class="block text-gray-700 text-sm font-medium mb-1">Identificador</label>
        <input
          v-model="form.identificador"
          id="identificador"
          type="text"
          required
          class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
        />
      </div>

      <div>
        <label for="descripcion" class="block text-gray-700 text-sm font-medium mb-1">Descripción</label>
        <textarea
          v-model="form.descripcion"
          id="descripcion"
          rows="4"
          class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
        ></textarea>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="precio" class="block text-gray-700 text-sm font-medium mb-1">Precio</label>
          <input
            v-model="form.precio"
            id="precio"
            type="number"
            step="0.01"
            min="0"
            required
            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
          />
        </div>

        <div>
          <label for="stock" class="block text-gray-700 text-sm font-medium mb-1">Stock</label>
          <input
            v-model="form.stock"
            id="stock"
            type="number"
            min="0"
            required
            class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
          />
        </div>
      </div>

      <div>
        <label for="categoria_id" class="block text-gray-700 text-sm font-medium mb-1">Categoría</label>
        <select
          v-model="form.categoria_id"
          id="categoria_id"
          required
          class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 bg-white shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
        >
          <option value="">Seleccione una categoría</option>
          <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
            {{ categoria.nombre }}
          </option>
        </select>
      </div>

      <div>
        <label for="estado" class="block text-gray-700 text-sm font-medium mb-1">Estado</label>
        <select
          v-model="form.estado"
          id="estado"
          required
          class="w-full rounded-xl border border-gray-300 px-4 py-2 text-gray-800 bg-white shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
        >
          <option :value="true">Activo</option>
          <option :value="false">Inactivo</option>
        </select>
      </div>

      <div class="flex items-center justify-between pt-6">
        <Link
          :href="route('productos.index')"
          class="text-sm px-5 py-2 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100 transition"
        >
          Cancelar
        </Link>

        <button
          type="submit"
          :disabled="form.processing"
          class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2 rounded-xl shadow-md transition disabled:opacity-50"
        >
          Actualizar Producto
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  producto: Object,
  categorias: Array
});

const form = useForm({
  nombre: props.producto.nombre,
  identificador: props.producto.identificador,
  descripcion: props.producto.descripcion,
  precio: props.producto.precio,
  stock: props.producto.stock,
  categoria_id: props.producto.categoria_id,
  estado: props.producto.estado
});

const submit = () => {
  form.put(route('productos.update', props.producto.id));
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
