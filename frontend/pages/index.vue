<template>
    <div class="container mx-auto mb-8">
      <NuxtPage />
      <h1 class="text-3xl font-bold underline my-8">
        Recipe Browser 3000
      </h1>

      <div class="grid grid-cols-2 gap-4 my-8">
        <div>
          <label for="ingredients" class="block text-sm font-medium text-gray-700">Ingredients</label>
          <select id="ingredients" class="block w-full mt-1 px-2 py-1 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="Wild Alaskan Sockeye">Wild Alaskan Sockeye</option>
            <option value="Wild Alaskan Coho">Wild Alaskan Coho</option>
            <option value="Wild Alaskan Cod">Wild Alaskan Cod</option>
            <option value="Wild Alaskan Rockfish">Wild Alaskan Rockfish</option>
            <option value="Wild Alaska Pollock">Wild Alaska Pollock</option>
            <option value="Wild Alaskan Lingcod">Wild Alaskan Lingcod</option>
            <option value="Wild Alaskan Halibut">Wild Alaskan Halibut</option>
            <option value="Wild Alaskan Sablefish">Wild Alaskan Sablefish</option>
          </select>
        </div>

        <div>
          <label for="author-email" class="block text-sm font-medium text-gray-700">Author email</label>
          <input type="text" id="author-email" class="block w-full mt-1 px-2 py-1 border rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
      </div>
      
      <Item />
    </div>
</template>
<script>
import Item from '~/components/Item.vue';
</script>
  