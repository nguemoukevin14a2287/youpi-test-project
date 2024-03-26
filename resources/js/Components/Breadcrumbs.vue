<template>
    <nav v-if="breadcrumbs" class="px-3 py-4">
        <ol class="breadcrumbs-list">
            <li v-for="(page, i) in breadcrumbs" class="breadcrumbs-item" :key="`bread-${i + 1}`">
                <span class="breadcrumbs-text border-b border-blue-400 current" v-if="page.current">{{ page.title }}</span>
                <a v-else :href="page.url" class="breadcrumbs-link">{{ page.title }}</a>
                <div>
                    <a :class="{ '': page.current }" ></a>
                </div>
            </li>
        </ol>
    </nav>
</template>

<script setup>
    const props = defineProps({
        breadcrumbs: {required: true}
    })
</script>

<style>
    .breadcrumbs-list {
        @apply flex gap-2;
    }
    .breadcrumbs-list .breadcrumbs-item {
        @apply flex gap-1 cursor-pointer;
    }
    .breadcrumbs-list .breadcrumbs-item:not(:last-child):after {
        content: "/";
    }
</style>