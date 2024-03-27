<script setup>
	import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
	import { Head, Link } from '@inertiajs/vue3'
	import DeleteResource from '@/Components/DeleteResource.vue'
	import NumberItems from '@/Components/NumberItems.vue'
	import Pagination from '@/Components/Pagination.vue'
	import IconEdit from '@/Components/IconEdit.vue'

	const props = defineProps({
		postes: {required: true}
	})
</script>


<template>
    <Head title="Liste des grapostesdes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des postes</h2>
        </template>

        <div class="content-page">
            <div class="tw-table-container">
                <table class="tw-table">
                    <thead class="tw-thead">
                        <th class="tw-th-col">Nom de code</th>
                        <th class="tw-th-col">Libele</th>
                        <th class="tw-th-col">Niveau</th>
                        <th class="tw-th-col">Employers</th>
                        <th class="tw-th-col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(poste, i) in postes.data" :key="poste.id">
                            <th scope="row" class="tw-td"><Link :href="route('postes.show', poste)" class="link">{{ poste.name }}</Link></th>
                            <td class="tw-td">{{ poste.title }}</td>
                            <td class="tw-td">{{ poste.level }}</td>
                            <td class="tw-td">{{ poste.employers_count }} employers</td>
                            <td class="tw-td">
                                <div class="flex items-center gap-2">
                                    <Link :href="route('grades.edit', poste)" class="link"><icon-edit /></Link>
                                    <delete-resource :url="route('postes.destroy', poste)" title="Supprimer ce grade" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex items-center gap-2 mt-4">
                <div class="p-3 col-span-2 flex items-end justify-around gap-2 grow" v-if="postes.total">
                    <Pagination :data="postes" />
                    <NumberItems :current="postes.per_page" key="number_products_per_page"  />
                </div>
                <Link :href="route('postes.create')" class="btn btn-success">Ajouter</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>