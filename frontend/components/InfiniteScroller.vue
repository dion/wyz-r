<template>
    <div class="infinite-scroller" ref="scroller">
      <div class="columns-3xs gap-8 space-y-8 mb-8">
        <div v-for="(item, index) in state.items" :key="index" class="item">
          <slot :item="item"></slot>
        </div>
      </div>
      <div v-if="props.state.loading" class="text-center mx-auto p-2.5">Loading...</div>
    </div>

</template>
  
<script setup>
  import { ref, reactive, onMounted } from 'vue';
    
    const props = defineProps({
      loadMore: Function,
      state: Object
    });
    const scroller = ref(null);
    let fetchTimeout = null;

    const debouncedFetch = () => {
      if (fetchTimeout && ref(!props.state.loading)) {
          clearTimeout(fetchTimeout);
      }
      fetchTimeout = setTimeout(props.loadMore, 200);
    };

    const handleScroll = () => {
      const { documentElement } = document;
      const windowHeight = window.innerHeight || documentElement.clientHeight;
      const bodyScrollHeight = documentElement.scrollHeight;
      const scrollTop = window.pageYOffset || documentElement.scrollTop || 0;
      
      if (bodyScrollHeight - scrollTop <= windowHeight) {
        debouncedFetch();
      }
    };

    onMounted(() => {
      props.loadMore();
      window.addEventListener('scroll', handleScroll);
    });
</script>
