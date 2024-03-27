<script setup>
	import { useForm } from '@inertiajs/vue3'
	import {ref, inject, computed} from 'vue'
	import defaultWorker from '@/../assets/images/default-worker.jpeg'
	import ErrorMsg from '@/Components/ErrorMsg.vue'

	const swal = inject('$swal')
	const postesList = ref([])
	const civilitiesList = ref(['célibataire', 'marié', 'divorcé'])
	const props = defineProps({
		employer: {default: () => ({})}
	})
	const defaultEmployer = {name: '', birthday: '', address: '', joined_at: '', salary: '', sexe: '', strengths: [], image: null, matricule: '', poste: 0, civility: 'marié'}
	const form = useForm({...defaultEmployer, ...props.employer})
	form.poste = form.poste || form.poste_id;
	const imgUploaded = ref(props.employer.image_path || defaultWorker)

	const isUpdate = computed(() => props.employer && props.employer.id && props.employer.id == parseInt(props.employer.id))

	const isLoadingPostes = ref(true)

	axios.get(route('fetch.grades.index')).then(res => {
		postesList.value = res.data
		isLoadingPostes.value = false
	})
	const save = () => {
		if(isUpdate.value){
			form.transform(data => ({...data, _method: 'put'})).post(route('employers.update', props.employer), {
				onSuccess: page => {
					swal.fire('Reussi', 'Employer mis a jour avec succes', 'success')
				}
			})
		} else {
			form.transform(data => data).post(route('employers.store'), {
				onSuccess: page => {
					swal.fire('Reussi', 'Employer enregistre avec succes', 'success')
					form.reset()
					form.image = null
					imgUploaded.value = defaultWorker
				}
			})
		}
	}
	const updateimage = event => {
		let file = event.target.files[0]
		form.image = file
		var reader  = new FileReader();

		reader.onloadend = function () {
			imgUploaded.value = reader.result;
		}

		if (file) {
			reader.readAsDataURL(file);
		} else {
			imgUploaded.value = defaultWorker;
		}
	}
</script>

<template>
	<form @submit.prevent="save">
		<div class="md:grid grid-cols-2 lg:grid-cols-3 gap-2">
			<div>
				<label for="matricule-input">Matricule:</label>
				<input id="matricule-input" class="form-control" v-model="form.matricule" type="text" required placeholder="Matricule complet de l'employer" :disabled="form.processing" />
				<error-msg :message="form.errors.matricule" />
			</div>
			<div>
				<label for="name-input">Nom:</label>
				<input id="name-input" class="form-control" v-model="form.name" type="text" required placeholder="Nom complet de l'employer" :disabled="form.processing" />
				<error-msg :message="form.errors.name" />
			</div>
			<div>
				<label for="poste-input">Poste:</label>
				<select name="poste" id="poste-input" class="form-control" v-model="form.poste" placeholder="Matricule de l'employer" :disabled="form.processing || isLoadingPostes">
					<option v-for="(poste, i) in postesList" :value="poste.id">{{ poste.title }}</option>
				</select>
				<error-msg :message="form.errors.poste" />
			</div>
			<div>
				<label for="civility-input">Civilite:</label>
				<select name="civility" id="civility-input" class="form-control" v-model="form.civility" placeholder="Matricule de l'employer" required :disabled="form.processing">
					<option v-for="(civility, i) in civilitiesList" :value="civility">{{ civility }}</option>
				</select>
				<error-msg :message="form.errors.civility" />
			</div>
			<div>
				<label for="address-input">Adresse:</label>
				<input id="address-input" class="form-control" v-model="form.address" type="text" required placeholder="Adresse de l'employer"  :disabled="form.processing"/>
				<error-msg :message="form.errors.address" />
			</div>
			<div>
				<label for="birthday-input">Date de naissance:</label>
				<input id="birthday-input" class="form-control" v-model="form.birthday" type="date" required placeholder="Date de naissance" :disabled="form.processing" />
				<error-msg :message="form.errors.birthday" />
			</div>
			<div>
				<label for="joined-at-input">Debut de service:</label>
				<input id="joined-at-input" class="form-control" v-model="form.joined_at" type="date" required placeholder="Date de recrutement" :disabled="form.processing" />
				<error-msg :message="form.errors.joined_at" />
			</div>
			<div>
				<label for="salary-input">Salaire:</label>
				<input id="salary-input" class="form-control" v-model="form.salary" type="number" min="10000" step="100" required placeholder="Quel est son salaire?" :disabled="form.processing" />
				<error-msg :message="form.errors.salary" />
			</div>
			<div class="self-end">
				<label for="sexe-input">Genre:</label>
				<div class="flex items-center gap-4">
					<label v-for="(s, j) in [{val: 'b', title: 'Homme'}, {val: 'g', title: 'Femme'}]" :for="`sexe-${s.val}-input`" :key="`sexe-${s.val}`" class="flex items-center gap-1 cursor-pointer">
						<input type="radio" name="sexe" v-model="form.sexe" class="checkbox" :value="s.val" :id="`sexe-${s.val}-input`" :disabled="form.processing" />
						<span>{{ s.title }}</span>
					</label>
				</div>
				<error-msg :message="form.errors.sexe" />
			</div>
			<div class="col-span-full"></div>
			<div class="bg-sky-100/50 p-2">
				<label for="image-input" class="cursor-pointer">
					<div>image:</div>
					<div class="img-iploaded">
						<img :src="imgUploaded" class="w-48 h-48 rounded-lg border border-2 border-slate-300" />
					</div>
				</label>
				<input id="image-input" class="form-control" @change="updateimage" type="file" accept="image/png, image/gif, image/jpeg" :disabled="form.processing" />
				<error-msg :message="form.errors.image" />
			</div>
			<div class="col-span-2 bg-sky-100 p-2">
				<label for="strengths-input">Qualites:</label>
				<div class="md:grid gap-2 grid-cols-2">
					<div class="flex items-center gap-2 mt-2" v-for="(strength, i) in form.strengths" :key="`strength-${i}`">
						<input :id="`strength-input-${i}`" class="form-control grow" v-model="form.strengths[i]" type="text" required placeholder="Entrer une qualite" :disabled="form.processing" />
						<button type="button" v-if="form.strengths.length > 1" class="btn btn-danger" @click="form.strengths.splice(i, 1)" :disabled="form.processing">
							<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
						</button>
					</div>
				</div>
				<div class="text-right mt-4">
					<button type="button" class="btn btn-primary" @click="form.strengths.push('')" :disabled="form.processing || form.strengths.filter(stren => stren.trim().length == 0).length > 0">
						<svg class="btn-svg" xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="4"><path d="M24 44c11.046 0 20-8.954 20-20S35.046 4 24 4S4 12.954 4 24s8.954 20 20 20Z"/><path stroke-linecap="round" d="M24 16v16m-8-8h16"/></g></svg> 
						<span class="btn-txt ml-2">qualite</span>
					</button>
				</div>
			</div>
		</div>
		<div class="text-center mt-4"><button class="btn btn-success" type="submit" :disabled="form.processing">{{ isUpdate ? 'Sauvegarder' : 'Enregistrer' }}</button></div>
	</form>
</template>