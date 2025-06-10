<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-gradient-to-br from-blue-50 via-white to-purple-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
      <div class="grid gap-6 md:grid-cols-3">
        <div class="relative aspect-video rounded-xl border border-blue-300 dark:border-blue-600 bg-white dark:bg-gray-900 shadow-lg p-4">
          <h3 class="text-lg font-semibold text-blue-700 dark:text-blue-300">PRODUCTOS VENDIDOS</h3>
          <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ productosVendidos }}</p>
        </div>
        <div class="relative aspect-video rounded-xl border border-green-300 dark:border-green-600 bg-white dark:bg-gray-900 shadow-lg p-4">
          <h3 class="text-lg font-semibold text-green-700 dark:text-green-300">USUARIOS REGISTRADOS</h3>
          <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ clientes }}</p>
        </div>
        <div class="relative aspect-video rounded-xl border border-yellow-300 dark:border-yellow-600 bg-white dark:bg-gray-900 shadow-lg p-4">
          <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300">PANEL ADICIONAL</h3>
          <PlaceholderPattern />
        </div>
      </div>

      <div class="relative min-h-[30vh] flex-1 rounded-xl border border-purple-300 dark:border-purple-600 bg-white dark:bg-gray-900 shadow-xl mt-6 p-6">
        <h3 class="text-lg font-semibold text-purple-700 dark:text-purple-300 mb-4">Sección Inferior</h3>
        <PlaceholderPattern />
      </div>

      <div class="mt-8 bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg border border-indigo-300 dark:border-indigo-600 max-w-3xl mx-auto">
        <h3 class="mb-4 text-xl font-semibold text-indigo-700 dark:text-indigo-300">Ventas por Mes</h3>
        <BarChart
          :labels="ventasPorMesLabels"
          :values="ventasPorMesData"
          label="Ventas"
        />
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import BarChart from '@/components/BarChart.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Dashboard',
    href: '/dashboard',
  },
];

defineProps([
  'productosVendidos',
  'clientes',
  'ventasPorMesLabels',
  'ventasPorMesData',
]);
</script>