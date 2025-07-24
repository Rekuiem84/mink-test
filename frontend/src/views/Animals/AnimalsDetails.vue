<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import AnimalCard from "@/components/AnimalCard.vue";

// Accès aux paramètres de l'URL
const route = useRoute();
const animal = ref(null);

const fetchAnimal = async () => {
	try {
		const id = route.params.id;
		const response = await axios.get(`http://localhost:8000/api/animals/${id}`);
		animal.value = response.data;
	} catch (error) {
		console.error("Erreur lors de la récupération de l'animal :", error);
	}
};

onMounted(() => {
	fetchAnimal();
});
</script>

<template>
	<AnimalCard v-if="animal" :animal="animal" />
	<div v-else>
		<p>Aucun animal trouvé</p>
	</div>
</template>
