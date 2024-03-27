<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import {ref} from 'vue'
import IconEdit from '@/Components/IconEdit.vue'
import DeleteResource from '@/Components/DeleteResource.vue'

const props = defineProps({
	poste: {required: true}
})

const relation = ref('')
</script>

<template>
		<Head :title="`Consulter ${poste.name}`" />
	<authenticated-layout>
		<template #header>
			<h2 class="h2-title">Consulter {{poste.name }}</h2>
		</template>
		<div class="content-page">
			<div class="poste-details">
				<div class="grid gap-2 md:grid-cols-2 lg:grid-cols-3">
					<div class="poste-detail">
						<p class="poste-lbl">Nom / Code</p>
						<div class="poste-value">{{ poste.name }}</div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl">Libele</p>
						<div class="poste-value">{{ poste.title }}</div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl">Grade</p>
						<div class="poste-value"><Link :href="route('grades.show', poste.grade)" class="link" target="_blank">{{ poste.grade.name }}</Link></div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl">Niveau</p>
						<div class="poste-value">{{ poste.level }}</div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl">Description</p>
						<div class="poste-value">{{ poste.description }}</div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl">Nombre</p>
						<div class="poste-value">{{ poste.employers_count }} employers</div>
					</div>
					<div class="poste-detail">
						<p class="poste-lbl flex items-center gap-2"><span>Nombre Employers</span>
							<button type="button" @click="relation = 'employers'" class="link text-2xl" :class="{active: relation == 'employers'}">
								<svg v-if="relation == 'employers'" xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24"><path fill="currentColor" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7"/></svg>
								<svg v-else xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
							</button>
						</p>
						<div class="poste-value">{{ poste.employers_count }}</div>
					</div>
				</div>
				<div class="flex items-center gap-3 mt-8">
					<Link :href="route('postes.edit', poste)" class="btn btn-primary"><icon-edit /> Editer</Link>
					<delete-resource :title="`Supprimer ${poste.name}`" :url="route('postes.destroy', poste)">Supprimer</delete-resource>
				</div>
				<div class="bg-slate-200/50 p-2 mt-8">
					<template v-if="relation == 'employers'">
						<h4 class="font-bold text-xl">Liste des employers: {{ poste.name }}</h4>
						<div class="tw-table-container">
							<table class="tw-table" v-if="poste.employers.length > 0">
								<thead class="tw-thead">
									<tr>
										<th class="tw-th-col">Matricule</th>
										<th class="tw-th-col">Nom</th>
										<th class="tw-th-col">Duree</th>
										<th class="tw-th-col">Age</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(employer, i) in poste.employers" :key="`employer-${employer.id}`">
										<th class="te-td" scope="row">{{ employer.matricule }}</th>
										<td class="tw-td"><Link :href="route('employers.show', employer)" class="link">{{ employer.name }}</Link></td>
										<td class="tw-td">{{ employer.age_work.all }}</td>
										<td class="tw-td">{{ employer.age }}</td>
									</tr>
								</tbody>
							</table>
							<div class="v-else">
								Aucun employer pour ce poste, <Link :href="route('employers.create', {poste: poste.id})" class="link">Ajouter un employer</Link> de ce poste
							</div>
						</div>
					</template>
				</div>
			</div>
		</div>
	</authenticated-layout>
</template>
<style>
	.poste-lbl {
		@apply font-bold text-lg;
	}
</style>