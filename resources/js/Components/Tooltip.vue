<template>
  <div class="flex flex-wrap" :class="classTheme">
    <div class="w-full text-center">
      <div ref="btnRef" @mouseenter="toggleTooltip" @mouseleave="toggleTooltip" class="font-bold ease-linear transition-all duration-150 cursor-pointer">
        <slot></slot>
      </div>
      <div ref="tooltipRef" v-bind:class="{'hidden': !tooltipShow, 'block': tooltipShow}" class="bg2-theme border-0 mb-3 block z-50 font-normal leading-normal text-sm max-w-xs text-left no-underline break-words rounded-lg">
        <div>
          <div class="bg2-theme text-white opacity-75 font-semibold p-3 mb-0 border-b border-solid uppercase rounded-t-lg" v-if="title &&  title.trim().length > 0">
            <span v-html="title"></span>
          </div>
          <div class="text-white p-3">
            <div v-html="content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { createPopper } from "@popperjs/core";
  import {ref} from 'vue'

  const props = defineProps({
    position: { default: 'top'},
    show: { default: false },
    title: { required: false, default: '' },
    content: { required: true },
    theme: { default: 'default' }
  })

  const tooltipShow = ref(props.show)
  const btnRef = ref(null)
  const tooltipRef = ref(null)
  const classTheme = ref('tooltip-' + props.theme)
  
  const toggleTooltip = () => {
    if(tooltipShow.value){
      tooltipShow.value = false;
    } else {
      tooltipShow.value = true;
      createPopper(btnRef.value, tooltipRef.value, {
        placement: props.position
      });
    }
  }
</script>

<script>
export default {
  name: "tooltip"
}
</script>

<style scoped>
  .tooltip-default .bg1-theme {
    @apply bg-gray-500 active:bg-gray-600 font-bold;
  }
  .tooltip-default .bg2-theme {
    @apply bg-gray-600 border-gray-100;
  }
  .tooltip-primary .bg1-theme{
    @apply bg-orange-500 active:bg-orange-600;
  }
  .tooltip-primary .bg1-theme{
    @apply bg-orange-600 border-orange-100;
  }
  .tooltip-dark{}
  .tooltip-scondary{}
  .tooltip-warning{}
  .tooltip-danger{}
  .tooltip-success{}
</style>