<template>
    <div class="container mx-auto">
      <div class="columns-3xs gap-8 space-y-8">
        <div v-for="(item, index) in recipes.data" :key="index" class="max-w-md mx-auto bg-white shadow-md rounded-md overflow-hidden">
            <h2>{{ item.name }}</h2>
            <p>{{ item.slug }}</p>
            <p>{{ item.author_email }}</p>
            <img :src="item.images[0]" />
        </div>
      </div>
    </div>
</template>
  
<script setup>
  const { data: recipes, pending, error, refresh } = await useFetch('http://localhost:8888/api/recipes', {});

  console.log('recipes', recipes.value.data);
//   TODO: add infinite scroll
// TODO: add link to recipe/[slug] page
// TODO: return first ingredient that has type protein
</script>