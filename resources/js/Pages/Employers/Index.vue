<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import DeleteResource from '@/Components/DeleteResource.vue'
import NumberItems from '@/Components/NumberItems.vue'
import Pagination from '@/Components/Pagination.vue'
import IconEdit from '@/Components/IconEdit.vue'

const props = defineProps({
    employers: {required: true}
})
</script>

<template>
    <Head title="Liste des employes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Liste des employes</h2>
        </template>

        <div class="content-page">
            <div class="tw-table-container">
                <table class="tw-table">
                    <thead class="tw-thead">
                        <th class="tw-th-col">#</th>
                        <th class="tw-th-col">Nom</th>
                        <th class="tw-th-col">Salaire</th>
                        <th class="tw-th-col">Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(employer, i) in employers.data" :key="employer.matricule">
                            <th scope="row" class="tw-td">{{ (employers.current_page - 1) * employers.per_page + i + 1 }}</th>
                            <td class="tw-td"><Link :href="route('employers.show', employer)" class="link">{{ employer.name }}</Link></td>
                            <td class="tw-td">{{ employer.salary }}</td>
                            <td class="tw-td">
                                <div class="flex items-center gap-2">
                                    <Link :href="route('employers.edit', employer)" class="link"><icon-edit /></Link>
                                    <delete-resource :url="route('employers.destroy', employer)" title="Supprimer cet employer" />
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex items-center gap-2 mt-4">
                    <div class="p-3 col-span-2 flex items-end justify-around gap-2 grow" v-if="employers.total">
                        <Pagination :data="employers" />
                        <NumberItems :current="employers.per_page" key="number_products_per_page"  />
                    </div>
                    <Link :href="route('employers.create')" class="btn btn-success">Ajouter</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>