<template>
	<p class="text-sm text-red-500" v-show="message.trim()">{{ message }}</p>
</template>

<script setup>
	const props = defineProps({
		message: {default: ''}
	})
</script>