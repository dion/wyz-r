<template>
    <div class="container mx-auto">
         <InfiniteScroller :loadMore="customLoadMore" :state="state">
            <template #default="{item}">
               <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden p-5">
                  <NuxtLink :to="`/recipes/${item.slug}`">
                     <div>
                        <h2 class="text-lg capitalize">{{ item.name }}</h2>
                        <p class="text-xs">{{ item.author_email }}</p>
                        <img :src="item.images[0]" class="mx-auto min-h-48 max-h-48 my-2.5" />
                        <p><span class="font-semibold text-sm">Ingredient</span><br/>{{ findFirstProtein(item.ingredients).name }}</p>
                     </div>
                  </NuxtLink>
               </div>
            </template>
         </InfiniteScroller>
    </div>
</template>
  
<script setup>
    import { ref } from "vue";
    import InfiniteScroller from '~/components/InfiniteScroller.vue';
    import { fetchRecipes } from '~/services/recipeService';

    let recipes = ref([]);
    let page = 2;
    const state = reactive({
        items: [],
        loading: false,
        error: false
    });
    
    const customLoadMore = async () => {
      state.loading = true;

      try {
         const pageNum = page == 2 ? 10 : 5; 
         const response = await fetchRecipes(page, pageNum);

         const json = await response;
         
         if (json.data.length > 1) {
               state.items = [...state.items, ...json.data];
               state.loading = false;
         }
         page++;
      } catch (error) {
         state.error = true;
      }
    };
    
    const findFirstProtein = function(arr) {
        return arr.find(item => item.type === 'protein') || null;
    }
</script>