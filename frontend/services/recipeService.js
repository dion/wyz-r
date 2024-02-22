// services/recipeService.js
import { useRecipeStore } from '~/store/recipe';

const BASE_URL = 'http://localhost:8888/api/recipes';

export async function fetchRecipes() {
  const recipeStore = useRecipeStore();

  recipeStore.setLoading(true);

  try {
    const url = new URL(BASE_URL);
    url.searchParams.append('page', recipeStore.page.toString());
    url.searchParams.append('limit', recipeStore.limit.toString());
    if (recipeStore.authorEmail) {
        url.searchParams.append('search[author_email]', recipeStore.authorEmail);
    }
    if (recipeStore.ingredient) {
        url.searchParams.append('search[ingredients][0]', recipeStore.ingredient);
    }

    const response = await fetch(url.toString());

    if (!response.ok) {
      throw new Error('Failed to fetch recipes');
    }

    const json = await response.json();
    if (json.data.length > 1) {
        recipeStore.setRecipes(json.data);
        recipeStore.setLoading(false);
        recipeStore.setPage(parseInt(recipeStore.page, 10) + 1);
    }

    return json;
  } catch (error) {
    throw new Error('Error fetching recipes');
  }
}
