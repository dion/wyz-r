<template>
    <div class="infinite-scroller">
      <div class="columns-3xs gap-8 space-y-8 mb-8">
        <div v-for="(item, index) in getRecipes" :key="index" class="item">
          <slot :item="item"></slot>
        </div>
      </div>
      <div v-if="getLoading" class="text-center mx-auto p-2.5">Loading...</div>
      <div ref="observerElement"></div>
    </div>
</template>
  
<script setup>
  import { ref, onMounted } from 'vue';
  import { useRecipeStore } from '~/store/recipe';

  const recipeStore = useRecipeStore();
  const { getLoading, getRecipes } = storeToRefs(recipeStore);
  const props = defineProps({
    loadMore: Function,
  });

  const observerElement = ref(null);
  let observer;
  let fetchTimeout = null;

  const debouncedFetch = () => {
    if (fetchTimeout && ref(!getLoading)) {
        clearTimeout(fetchTimeout);
    }
    fetchTimeout = setTimeout(props.loadMore, 400);
  };

  const observerCallback = (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        debouncedFetch();
      }
    });
  };

  onMounted(() => {
    observer = new IntersectionObserver(observerCallback, {
      root: null,
      rootMargin: '50px',
      threshold: 0.5,
    });

    observer.observe(observerElement.value);
  });
</script>
