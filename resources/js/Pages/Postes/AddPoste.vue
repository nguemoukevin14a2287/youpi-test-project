<script setup>
	import { useForm } from '@inertiajs/vue3'
	import {ref, inject, computed} from 'vue'
	import defaultWorker from '@/../assets/images/default-worker.jpeg'
	import ErrorMsg from '@/Components/ErrorMsg.vue'

	const swal = inject('$swal')
	const props = defineProps({
		poste: {default: () => ({})}
	})
	const defaultposte = {name: '', title: '', level: '', desciption: '', salary: 0, grade_id: 0}
	const form = useForm({...defaultposte, ...props.poste})
	const gradesList = ref([])
	const isLoadingGrades = ref(true)

	axios.get(route('fetch.grades.index')).then(res => {
		gradesList.value = res.data
		isLoadingGrades.value = false
	})

	const isUpdate = computed(() => props.poste && props.poste.id && props.poste.id == parseInt(props.poste.id))

	const save = () => {
		if(isUpdate.value){
			form.transform(data => ({...data, _method: 'put'})).post(route('postes.update', props.poste), {
				onSuccess: page => {
					swal.fire('Reussi', 'poste mis a jour avec succes', 'success')
				}
			})
		} else {
			form.transform(data => data).post(route('postes.store'), {
				onSuccess: page => {
					swal.fire('Reussi', 'poste enregistre avec succes', 'success')
					form.reset()
				}
			})
		}
	}
</script>

<template>
	<form @submit.prevent="save">
		<div class="md:grid grid-cols-2 lg:grid-cols-3 gap-2">
			<div>
				<label for="grade-input">Grade:</label>
				<select name="grade" id="poste-input" class="form-control" v-model="form.grade_id" placeholder="Matricule de l'employer" :disabled="isLoadingGrades || form.processing">
					<option v-for="(grade, i) in gradesList" :value="grade.id">{{ grade.title }}</option>
				</select>
				<error-msg :message="form.errors.grade_id" />
			</div>
			<div>
				<label for="name-input">Nom / code:</label>
				<input id="name-input" class="form-control" v-model="form.name" type="text" required placeholder="Nom ou code du poste" :disabled="form.processing" />
				<error-msg :message="form.errors.name" />
			</div>
			<div>
				<label for="title-input">Libele:</label>
				<input id="title-input" class="form-control" v-model="form.title" type="text" required placeholder="Libele explicite du poste"  :disabled="form.processing"/>
				<error-msg :message="form.errors.title" />
			</div>
			<div>
				<label for="level-input">Niveau:</label>
				<input id="level-input" class="form-control" v-model="form.level" type="number" step="1" min="1" required placeholder="Niveau d'acreditation" :disabled="form.processing" />
				<error-msg :message="form.errors.level" />
			</div>
			<div class="col-span-2">
				<label for="description-input">Description:</label>
				<textarea id="description-input" class="form-control" v-model="form.description" type="text" required placeholder="Description du poste explicite" cols="50" rows="10" :disabled="form.processing"></textarea>
				<error-msg :message="form.errors.description" />
			</div>
		</div>
		<div class="text-center mt-4"><button class="btn btn-success" type="submit" :disabled="form.processing">{{ isUpdate ? 'Sauvegarder' : 'Enregistrer' }}</button></div>
	</form>
</template>