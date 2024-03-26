<script setup>
	import { inject, ref } from 'vue'
	import { useForm } from '@inertiajs/vue3'

	const props = defineProps({
		title: {required: true},
		url: {required: true}
	})

    const emit = defineEmits(['deleted']);

	const form = useForm({})
	const swal = inject('$swal')

	const destroy = (title, url) => {
		swal.fire({
			title: "Confirm",
			text: "Do really want to delete this: " + title,
			icon: 'question',
			showDenyButton: true,
			confirmButtonText: "Cancel",
			denyButtonText: "Delete"
		}).then(conf => {
			if(conf.isDenied) {
				form.delete(url, {
					onSuccess: response => {
					swal.fire('Success', "Deleted successfully", 'success')
                    emit('deleted')
				}});
			}
		});
	}
</script>

<template>
	<button @click="destroy(title, url)" class="p-1 text-white bg-red-600 border border-red-600 hover:bg-red-500 hover:border-red-500 rounded flex items-center" :title="title">
		<span class="inline-block">
			<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>
		</span>
		<slot></slot>
	</button>
</template>
