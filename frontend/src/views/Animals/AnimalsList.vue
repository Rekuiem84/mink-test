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
	<h1 class="text-4xl text-[rgb(232,232,232)] font-bold">Liste des animaux</h1>
	<RouterLink
		to="/animals/new"
		class="inline-block my-4 px-4 py-2 bg-[hsla(160,100%,37%,1)] text-white font-bold rounded-lg">
		Ajouter un nouvel animal
	</RouterLink>
	<div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-4">
		<RouterLink
			:to="`/animals/${animal.id}`"
			class="block no-underline text-inherit"
			v-for="animal in animals"
			:key="animal.id">
			<AnimalCard :animal="animal" />
		</RouterLink>
	</div>
</template>
