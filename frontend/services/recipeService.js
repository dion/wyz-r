// services/recipeService.js

const BASE_URL = 'http://localhost:8888/api/recipes';

export async function fetchRecipes(page = 1, limit = 5, authorEmail = '', ingredient = '') {
  try {
    const url = new URL(BASE_URL);
    url.searchParams.append('page', page);
    url.searchParams.append('limit', limit);
    if (authorEmail) {
        url.searchParams.append('search[author_email]', authorEmail);
    }
    if (ingredient) {
    url.searchParams.append('search[ingredients][0]', ingredient);
    }

    const response = await fetch(url.toString());

    if (!response.ok) {
      throw new Error('Failed to fetch recipes');
    }

    return await response.json();
  } catch (error) {
    throw new Error('Error fetching recipes');
  }
}
