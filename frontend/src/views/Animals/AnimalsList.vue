<script setup>
import axios from "axios";
import { ref, onMounted, watch } from "vue";
import AnimalCard from "@/components/AnimalCard.vue";
import { useRoute, useRouter } from "vue-router";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

const route = useRoute();
const router = useRouter();
const animals = ref([]);
const types = ref([]);
const breeds = ref([]);

// Valeurs des filtres
const selectedType = ref(route.query.type || "");
const selectedBreed = ref(route.query.breed || "");

const buildQuery = () => {
	const query = new URLSearchParams();
	if (route.query.name) {
		query.set("name", route.query.name);
	}
	if (route.query.isAvailable) {
		query.set("isAvailable", route.query.isAvailable);
	}
	if (route.query.type) {
		query.set("type", route.query.type);
	}
	if (route.query.breed) {
		query.set("breed", route.query.breed);
	}
	return query;
};

const fetchAnimals = async () => {
	try {
		const query = buildQuery();
		const response = await axios.get(
			`${API_BASE_URL}/animals?${query.toString()}`
		);
		animals.value = response.data["member"];
	} catch (error) {
		console.error("Error fetching animals:", error);
	}
};

const fetchTypes = async () => {
	try {
		const response = await axios.get(`${API_BASE_URL}/types`);
		types.value = response.data["member"] || [];
	} catch (error) {
		console.error("Error fetching types:", error);
	}
};

const fetchBreeds = async () => {
	try {
		const response = await axios.get(`${API_BASE_URL}/breeds`);
		breeds.value = response.data["member"] || [];
	} catch (error) {
		console.error("Error fetching breeds:", error);
	}
};

// Fonction pour mettre à jour les filtres
const updateFilters = () => {
	const query = { ...route.query };

	if (selectedType.value) {
		query.type = selectedType.value;
	} else {
		delete query.type;
	}

	if (selectedBreed.value) {
		query.breed = selectedBreed.value;
	} else {
		delete query.breed;
	}

	router.push({ name: "animalsList", query });
};

// Fonction pour réinitialiser tous les filtres
const resetFilters = () => {
	selectedType.value = "";
	selectedBreed.value = "";
	router.push({ name: "animalsList" });
};

// Surveiller les changements de route pour refaire l'appel API
watch(
	() => route.query,
	() => {
		selectedType.value = route.query.type || "";
		selectedBreed.value = route.query.breed || "";
		fetchAnimals();
	},
	{ immediate: true }
);

onMounted(() => {
	fetchAnimals();
	fetchTypes();
	fetchBreeds();
});
</script>

<template>
	<h1 class="text-4xl text-[rgb(232,232,232)] font-bold">Liste des animaux</h1>
	<RouterLink
		to="/animals/new"
		class="inline-block my-4 px-4 py-2 bg-[hsla(160,100%,37%,1)] text-white font-bold rounded-lg">
		Ajouter un nouvel animal
	</RouterLink>

	<h3 class="text-[rgb(232,232,232)] text-xl font-semibold mb-4">Filtrer</h3>

	<!-- Filtres de disponibilité -->
	<div class="mb-4">
		<RouterLink
			:to="{
				name: 'animalsList',
				query: { ...route.query, isAvailable: true },
			}"
			class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg mr-2">
			Disponibles
		</RouterLink>
		<RouterLink
			:to="{
				name: 'animalsList',
				query: { ...route.query, isAvailable: 'false' },
			}"
			class="inline-block px-4 py-2 bg-red-500 text-white rounded-lg mr-2">
			Indisponibles
		</RouterLink>
	</div>

	<!-- Filtres select pour types et races -->
	<div class="mb-6 flex flex-wrap gap-4 items-center">
		<div class="flex flex-col">
			<label for="type-filter" class="text-[rgb(232,232,232)] font-medium mb-1"
				>Type</label
			>
			<select
				id="type-filter"
				v-model="selectedType"
				@change="updateFilters"
				class="px-3 py-2 bg-[#333] text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]">
				<option value="">Tous les types</option>
				<option v-for="type in types" :key="type.id" :value="type.id">
					{{ type.name }}
				</option>
			</select>
		</div>

		<div class="flex flex-col">
			<label for="breed-filter" class="text-[rgb(232,232,232)] font-medium mb-1"
				>Race</label
			>
			<select
				id="breed-filter"
				v-model="selectedBreed"
				@change="updateFilters"
				class="px-3 py-2 bg-[#333] text-white border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]">
				<option value="">Toutes les races</option>
				<option v-for="breed in breeds" :key="breed.id" :value="breed.id">
					{{ breed.name }}
				</option>
			</select>
		</div>

		<button
			@click="resetFilters"
			class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 mt-6">
			Réinitialiser
		</button>
	</div>

	<div class="grid grid-cols-[repeat(auto-fill,minmax(300px,1fr))] gap-4">
		<RouterLink
			:to="{ name: 'animalsDetails', params: { id: animal.id } }"
			class="block no-underline text-inherit"
			v-for="animal in animals"
			:key="animal.id">
			<AnimalCard :animal="animal" />
		</RouterLink>
	</div>
</template>
