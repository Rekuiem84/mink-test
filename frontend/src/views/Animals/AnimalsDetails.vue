<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import router from "@/router";
import { useRoute } from "vue-router";
import AnimalCard from "@/components/AnimalCard.vue";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

// Accès aux paramètres de l'URL
const route = useRoute();
const animal = ref(null);

const fetchAnimal = async () => {
	try {
		const id = route.params.id;
		const response = await axios.get(`${API_BASE_URL}/animals/${id}`);
		animal.value = response.data;
	} catch (error) {
		console.error("Erreur lors de la récupération de l'animal :", error);
	}
};

const isDeleting = ref(false);

const deleteAnimal = async () => {
	if (!animal.value) return;

	if (!confirm(`Confirmer la suppression de ${animal.value.name} ?`)) {
		return;
	}

	isDeleting.value = true;

	try {
		await axios.delete(`${API_BASE_URL}/animals/${animal.value.id}`);
		alert(`${animal.value.name} supprimé.`);
		router.push("/animals");
	} catch (error) {
		console.error("Erreur suppression :", error);
		alert("Erreur lors de la suppression.");
	} finally {
		isDeleting.value = false;
	}
};

onMounted(() => {
	fetchAnimal();
});
</script>

<template>
	<AnimalCard v-if="animal" :animal="animal" />
	<RouterLink
		:to="{ name: 'animalsEdit', params: { id: route.params.id } }"
		class="inline-block my-2 ml-2 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg">
		Modifier
	</RouterLink>
	<button
		@click="deleteAnimal"
		:disabled="isDeleting"
		class="inline-block my-4 ml-2 px-4 py-2 bg-red-500 text-white font-bold rounded-lg"
		type="button">
		{{ isDeleting ? "Suppression..." : "Supprimer" }}
	</button>
	<!-- <div v-else>
		<p>Aucun animal trouvé</p>
	</div> -->
</template>
