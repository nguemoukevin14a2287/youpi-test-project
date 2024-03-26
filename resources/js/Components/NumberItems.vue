<script setup>
	import {ref} from 'vue'
	import { useForm, Link } from '@inertiajs/vue3'
	import TextInput from '@/Components/TextInput.vue'
	import InputLabel from '@/Components/InputLabel.vue'
	import PrimaryButton from '@/Components/PrimaryButton.vue'
	import Checkbox from '@/Components/Checkbox.vue'

	let doeSave = ref(false)

	const props = defineProps({
		key: {required: true},
		current: {required: true}
	});

	let obj = {};
	obj[props.key] = '' + props.current

	const form = useForm(obj);

	const save = () => {
		form.post(route('update-settings'))
	}
</script>

<template>
	<form class="" @submit.prevent="save">
		<InputLabel for="number" value="Nombre d'elements" class="mb-2" />
		<div class="flex items-center">
			<div class="flex items-center gap-2">
				<input id="number" type="number" v-model="form[key]" class="form-control max-w-[4rem] text-xs p-2" />
				<!-- <label class="flex items-center" v-if="form[key] != current"> -->
				<label class="flex items-center" v-if="false">
					<Checkbox name="save-setting" v-model:checked="doeSave" />
					<span class="ms-2 text-sm text-gray-600">Save it</span>
				</label>
			</div>
			<template v-if="form[key] != current">
				<template v-if="doeSave">
					<PrimaryButton type="submit" class="ms-4 text-xs max-h-[2rem]" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
				</template>
				<template v-else>
					<Link :href="route(route().current(), {...route().params, number_items: form[key]})" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-4 text-xs max-h-[2rem]">Charger</Link>
				</template>
			</template>
		</div>
	</form>
</template>
