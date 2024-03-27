<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import AddPoste from './AddPoste.vue'
const props = defineProps({
	poste: {default: () => ({})}
})
</script>

<template>
		<Head title="Ajouter un poste" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">Ajouter un poste</h2>
		</template>
		<div class="content-page">
			<add-poste :poste="poste" />
		</div>
	</authenticated-layout>
</template>