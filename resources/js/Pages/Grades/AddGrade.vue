<script setup>
	import { useForm } from '@inertiajs/vue3'
	import {ref, inject, computed} from 'vue'
	import defaultWorker from '@/../assets/images/default-worker.jpeg'
	import ErrorMsg from '@/Components/ErrorMsg.vue'

	const swal = inject('$swal')
	const props = defineProps({
		grade: {default: () => ({})}
	})
	const defaultGrade = {name: '', title: '', level: '', desciption: ''}
	const form = useForm({...defaultGrade, ...props.grade})

	const isUpdate = computed(() => props.grade && props.grade.id && props.grade.id == parseInt(props.grade.id))

	const save = () => {
		if(isUpdate.value){
			form.transform(data => ({...data, _method: 'put'})).post(route('grades.update', props.grade), {
				onSuccess: page => {
					swal.fire('Reussi', 'grade mis a jour avec succes', 'success')
				}
			})
		} else {
			form.transform(data => data).post(route('grades.store'), {
				onSuccess: page => {
					swal.fire('Reussi', 'Grade enregistre avec succes', 'success')
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
				<label for="name-input">Nom / code:</label>
				<input id="name-input" class="form-control" v-model="form.name" type="text" required placeholder="Nom ou code du grade" :disabled="form.processing" />
				<error-msg :message="form.errors.name" />
			</div>
			<div>
				<label for="title-input">Libele:</label>
				<input id="title-input" class="form-control" v-model="form.title" type="text" required placeholder="Libele explicite du grade"  :disabled="form.processing"/>
				<error-msg :message="form.errors.title" />
			</div>
			<div>
				<label for="level-input">Niveau:</label>
				<input id="level-input" class="form-control" v-model="form.level" type="number" step="1" min="1" required placeholder="Niveau d'acreditation" :disabled="form.processing" />
				<error-msg :message="form.errors.level" />
			</div>
			<div class="col-span-2">
				<label for="description-input">Descriptiom:</label>
				<textarea id="description-input" class="form-control" v-model="form.description" type="text" required placeholder="Description du grade explicite" cols="50" rows="10" :disabled="form.processing"></textarea>
				<error-msg :message="form.errors.description" />
			</div>
		</div>
		<div class="text-center mt-4"><button class="btn btn-success" type="submit" :disabled="form.processing">{{ isUpdate ? 'Sauvegarder' : 'Enregistrer' }}</button></div>
	</form>
</template>