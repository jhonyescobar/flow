<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-900 dark:text-white flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-800 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6M9 5v6h13V5M3 5h2M3 10h2M3 15h2M3 20h2" />
          </svg>
          Reportes de Ventas
        </h1>
        <div class="flex justify-between items-center mb-6">
        <a
          href="/pdf"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          target="_blank"
        >
          <span>Descargar PDF</span>
        </a>
      </div>
        <div class  ="flex gap mb-4">
          <div>
            <label for="fechaInicio" class="block text-xs">desde:</label>
            <input type="date" v-model="fechaInicio" id="fechaInicio"
            class="border rounded px-2 py-1"/>

          </div>
          <div>
            <label form="fechaFin" class="block text-xs">hasta: </label>
            <input type="date" v-model="fechaFin" id="fechaFin"
            class="border rounded px-2 py-1"/>
          </div>
        </div>
        

      </div>

      <div v-if="ventas.length" class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full table-auto text-sm text-left text-gray-700 dark:text-gray-200">
          <thead class="bg-blue-900 text-white">
            <tr>
              <th class="py-3 px-4">ID</th>
              <th class="py-3 px-4">Cliente</th>
              <th class="py-3 px-4">Total</th>
              <th class="py-3 px-4">Fecha</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="venta in ventasFiltradas"  :key="venta.id" class="hover:bg-blue-50 dark:hover:bg-gray-700 transition">
              <td class="py-2 px-4 font-medium">{{ contador++ }}</td>
              <td class="py-2 px-4">{{ venta.cliente_nombre }}</td>
              <td class="py-2 px-4">{{ venta.total }}</td>
              <td class="py-2 px-4">{{ venta.fecha_registro }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-else class="text-center text-gray-500 dark:text-gray-400 mt-10">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 mb-2 text-blue-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13v6M9 5v6h13V5M3 5h2M3 10h2M3 15h2M3 20h2" />
        </svg>
        <p>No hay ventas disponibles.</p>
      </div>
    </div>
    
  </AppSidebarLayout>
</template>


<script setup>
import { Link } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { ref,computed } from 'vue';

const fechaInicio = ref('');
const fechaFin = ref('');

const ventasFiltradas=computed(()=>{
  return props.ventas.filter(venta=>{
    const fecha = venta.fecha_registro.substring(0,10);
    const desde = fechaInicio.value?fechaInicio.value:'0000-00-00';
    const hasta= fechaFin.value? fechaFin.value:'9999-12-31'
    return fecha>= desde && fecha<=hasta;
  });
});

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});
const contador=1;

</script>
