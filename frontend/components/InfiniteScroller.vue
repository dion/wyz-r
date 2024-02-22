<template>
    <div class="infinite-scroller" ref="scroller">
      <div class="columns-3xs gap-8 space-y-8 mb-8">
        <div v-for="(item, index) in getRecipes" :key="index" class="item">
          <slot :item="item"></slot>
        </div>
      </div>
      <div v-if="getLoading" class="text-center mx-auto p-2.5">Loading...</div>
    </div>
</template>
  
<script setup>
  import { ref, reactive, onMounted } from 'vue';
  import { useRecipeStore } from '~/store/recipe';

  const recipeStore = useRecipeStore();
  const { getLoading, getRecipes } = storeToRefs(recipeStore);

  const props = defineProps({
    loadMore: Function,
  });
  const scroller = ref(null);
  let fetchTimeout = null;

  const debouncedFetch = () => {
    if (fetchTimeout && ref(!getLoading)) {
        clearTimeout(fetchTimeout);
    }
    fetchTimeout = setTimeout(props.loadMore, 400);
  };

  const handleScroll = () => {
    const { documentElement } = document;
    const windowHeight = window.innerHeight || documentElement.clientHeight;
    const bodyScrollHeight = documentElement.scrollHeight;
    const scrollTop = window.pageYOffset || documentElement.scrollTop || 0;
    
    if ((bodyScrollHeight - scrollTop) - 50 <= windowHeight) {
      debouncedFetch();
    }
  };

  onMounted(() => {
    props.loadMore();
    window.addEventListener('scroll', handleScroll);
  });
</script>
