<script setup >
    import { Link, router } from '@inertiajs/vue3'
    import { onMounted, ref } from 'vue'

    const props = defineProps({
        data: {default: () => ({})}
    })

    const currentPage = ref(props.data.current_page);
    onMounted(() => {
        if(props.data.current_page > props.data.last_page) {
            router.visit(urlPage(1));
        }
    })

    const urlPage = page => {
        let url = route(route().current(), {...route().params, page: page})
        return url
    }
    const onClickHandler = (page) => {
        router.visit(urlPage(page))
  };
</script>

<template>
        <div v-if="data.total > data.per_page">
          <vue-awesome-paginate
              :total-items="data.total"
              :items-per-page="data.per_page"
              :max-pages-shown="3"
              v-model="currentPage"
              :on-click="onClickHandler"
              type="link"
              :link-url="`${route(route().current(), {...route().params})}?page=[page]`"
          />
    </div>
</template>

<style>
  .pagination-container {
    display: flex;
    column-gap: 10px;
  }
  .paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: rgb(242, 242, 242);
    border: 1px solid rgb(217, 217, 217);
    color: black;
  }
  .paginate-buttons:hover {
    background-color: #d8d8d8;
  }
  .active-page {
    background-color: #3498db;
    border: 1px solid #3498db;
    color: white;
  }
  .active-page:hover {
    background-color: #2988c8;
  }
</style>