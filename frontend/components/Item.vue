<template>
    <div class="container mx-auto">
         <InfiniteScroller :loadMore="customLoadMore">
            <template #default="{item}">
               <div class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden p-5">
                  <NuxtLink :to="`/recipes/${item.slug}`">
                     <div>
                        <h2 class="text-lg capitalize">{{ item.name }}</h2>
                        <p class="text-xs">{{ item.author_email }}</p>
                        <NuxtImg format="webp" loading="lazy" :src="item.images[0]" class="mx-auto min-h-48 max-h-48 my-2.5" :alt="item.name" height="192" />
                        <p><span class="font-semibold text-sm">Ingredient</span><br/>{{ findFirstProtein(item.ingredients).name }}</p>
                     </div>
                  </NuxtLink>
               </div>
            </template>
         </InfiniteScroller>
    </div>
</template>
  
<script setup>
    import InfiniteScroller from '~/components/InfiniteScroller.vue';
    import { fetchRecipes } from '~/services/recipeService';
    import { useRecipeStore } from '~/store/recipe';

    const recipeStore = useRecipeStore();

    const customLoadMore = async () => {
      recipeStore.loading = true;

      try {
         const response = await fetchRecipes();
      } catch (error) {}
    };
    
    const findFirstProtein = function(arr) {
        return arr.find(item => item.type === 'protein') || null;
    }
</script>