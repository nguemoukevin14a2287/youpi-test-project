<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import AddEmployer from './AddEmployer.vue'
import DeleteResource from '@/Components/DeleteResource.vue'
import IconEdit from '@/Components/IconEdit.vue'
import Tooltip from '@/Components/Tooltip.vue'

const props = defineProps({
	employer: {required: true}
})
</script>

<template>
		<Head :title="employer.name" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">{{ employer.name }}</h2>
		</template>
		<div class="content-page">
			<div class="employer-details">
				<div class="flex items-center justify-center">
					<div class="image text-center mb-4">
						<img :src="employer.image_path" alt="Image employer" class="w-48 h-hauto rounded-xl border border-2 border-slate-400">
						<div class="employer-value">{{ employer.name_full }}</div>
					</div>
				</div>
				<div class="grid md-grid-cols-2 lg:grid-cols-3 md:gap-4 gap-2">
					<div class="employer-detail">
						<p class="employer-lbl">Matricule</p>
						<div class="employer-value">{{ employer.matricule }}</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Genre</p>
						<div class="employer-value">{{ employer.sexe_full }}</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Civilite</p>
						<div class="employer-value">{{ employer.civility }}</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Nom</p>
						<div class="employer-value">{{ employer.name }}</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Poste</p>
						<div class="employer-value">
							<Link v-if="employer.poste" :href="route('postes.show', employer.poste)" class="link">{{ employer.poste.title }}</Link>
							<div v-else>Sans poste</div>
						</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Grade</p>
						<div class="employer-value">
							<Link v-if="employer.grade" :href="route('grades.show', employer.grade)" class="link">{{ employer.grade.title }}</Link>
							<div v-else>Aucun</div>
						</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Salaire</p>
						<div class="employer-value">{{ employer.salary }} XAF</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Adresse</p>
						<div class="employer-value">{{ employer.address }}</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Date naissance (Age)</p>
						<div class="employer-value">{{ employer.birthday_full }}({{ employer.age }})</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Recrutement</p>
						<div class="employer-value">
							<tooltip :content="`<p>${employer.age_work.months}</p><p>${employer.age_work.years}</p><p>${employer.age_work.days}</p>`"><span class="limit-1-line">{{ employer.joined_at_full }}({{ employer.age_work.all }})</span></tooltip>
						</div>
					</div>
					<div class="employer-detail">
						<p class="employer-lbl">Qualites</p>
						<div class="employer-value">{{ employer.strengths.join(', ') }}</div>
					</div>
				</div>
				<div class="flex items-center gap-3 mt-8">
					<Link :href="route('employers.edit', employer)" class="btn btn-primary"><icon-edit /> Editer</Link>
					<delete-resource :title="`Supprimer ${employer.name}`" :url="route('employers.destroy', employer)">Supprimer</delete-resource>
				</div>
			</div>
		</div>
	</authenticated-layout>
</template>

<style scoped>
	.employer-details {}
	.employer-details .employer-detail {}
	.employer-details .employer-detail .employer-lbl {
		@apply font-bold text-lg;
	}
	.employer-details .employer-detail .employer-value {}
</style>