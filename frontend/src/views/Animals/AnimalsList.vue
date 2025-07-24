<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import AnimalCard from "@/components/AnimalCard.vue";

onMounted(() => {
	fetchAnimals();
});
const animals = ref([]);
const fetchAnimals = async () => {
	try {
		const response = await axios.get("http://localhost:8000/api/animals");
		animals.value = response.data["member"];
		console.log(animals.value);
	} catch (error) {
		console.error("Error fetching animals:", error);
	}
};
</script>

<template>
	<div class="animals-list">
		<h1>Animals List</h1>
		<AnimalCard v-for="animal in animals" :key="animal.id" :animal="animal" />
	</div>
</template>
