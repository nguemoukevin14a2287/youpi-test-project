<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import AddPoste from './AddPoste.vue'
const props = defineProps({
	poste: {required: true}
})
</script>

<template>
		<Head title="Editer un poste" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">Editer un poste</h2>
		</template>
		<div class="content-page">
			<add-poste :poste="poste" />
		</div>
	</authenticated-layout>
</template>