<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import AddGrade from './AddGrade.vue'
const props = defineProps({
	grade: {default: () => ({})}
})
</script>

<template>
		<Head title="Ajouter un grade" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">Ajouter un grade</h2>
		</template>
		<div class="content-page">
			<add-grade :grade="grade" />
		</div>
	</authenticated-layout>
</template>