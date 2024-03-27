<script setup>
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
	import { Head, Link } from '@inertiajs/vue3'
	import DeleteResource from '@/Components/DeleteResource.vue'
	import NumberItems from '@/Components/NumberItems.vue'
	import Pagination from '@/Components/Pagination.vue'
	import IconEdit from '@/Components/IconEdit.vue'

	const props = defineProps({
		grades: {required: true}
	})
</script>


<template>
    <Head title="Liste des grades" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des grades</h2>
        </template>

        <div class="content-page">
            <div class="tw-table-container">
                <table class="tw-table">
                    <thead class="tw-thead">
                        <th class="tw-th-col">Nom de code</th>
                        <th class="tw-th-col">Libele</th>
                        <th class="tw-th-col">Niveau</th>
                        <th class="tw-th-col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(grade, i) in grades.data" :key="grade.id">
                            <th scope="row" class="tw-td"><Link :href="route('grades.show', grade)" class="link">{{ grade.name }}</Link></th>
                            <td class="tw-td">{{ grade.title }}</td>
                            <td class="tw-td">{{ grade.level }}</td>
                            <td class="tw-td">
                                <div class="flex items-center gap-2">
                                    <Link :href="route('grades.edit', grade)" class="link"><icon-edit /></Link>
                                    <delete-resource :url="route('grades.destroy', grade)" title="Supprimer ce grade" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <div class="p-3 col-span-2 flex items-end justify-around gap-2 grow" v-if="grades.total">
                    <Pagination :data="grades" />
                    <NumberItems :current="grades.per_page" key="number_products_per_page"  />
                </div>
                <Link :href="route('grades.create')" class="btn btn-success">Ajouter</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>