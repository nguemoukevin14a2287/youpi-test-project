<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AddEmployer from './AddEmployer.vue'
</script>

<template>
		<Head title="Ajouter un employer" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">Ajouter un employer</h2>
		</template>
		<div class="content-page">
			<add-employer />
		</div>
	</authenticated-layout>
</template>