<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

const route = useRoute();
const router = useRouter();

const animal = ref({
	name: "",
	age: null,
	description: "",
	price: null,
	isAvailable: true,
	type: null,
	breed: null,
});
const types = ref([]);
const breeds = ref([]);
const isSubmitting = ref(false);

// Charger l'animal
const fetchAnimal = async () => {
	try {
		const id = route.params.id;
		const response = await axios.get(`${API_BASE_URL}/animals/${id}`);
		animal.value = {
			...response.data,
			type: response.data.type["@id"], // on vient récupérer l'ID du type plutôt que l'objet complet
			breed: response.data.breed["@id"],
		};
	} catch (err) {
		console.error("Erreur :", err);
	}
};

// Charger les types et races
const fetchSelectData = async () => {
	try {
		const [resTypes, resBreeds] = await Promise.all([
			axios.get(`${API_BASE_URL}/types`),
			axios.get(`${API_BASE_URL}/breeds`),
		]);
		types.value = resTypes.data["member"];
		breeds.value = resBreeds.data["member"];
	} catch (err) {
		console.error("Erreur chargement select :", err);
	}
};

const updateAnimal = async () => {
	isSubmitting.value = true;
	try {
		await axios.patch(
			`${API_BASE_URL}/animals/${route.params.id}`,
			animal.value,
			{
				headers: { "Content-Type": "application/merge-patch+json" },
			}
		);
		alert("Animal modifié avec succès !");
		router.push("/");
	} catch (err) {
		console.error("Erreur lors de la mise à jour :", err);
		alert("Erreur lors de la mise à jour.");
	} finally {
		isSubmitting.value = false;
	}
};

onMounted(() => {
	fetchAnimal();
	fetchSelectData();
});
</script>

<template>
	<h1 class="text-3xl font-bold text-[rgb(232,232,232)] mb-4">
		Modifier l'animal
	</h1>

	<form @submit.prevent="updateAnimal" class="space-y-4 text-white">
		<div>
			<label>Nom</label>
			<input
				v-model="animal.name"
				type="text"
				class="w-full p-2 rounded bg-[#333]"
				required />
		</div>
		<div>
			<label>Âge</label>
			<input
				v-model="animal.age"
				type="number"
				min="0"
				class="w-full p-2 rounded bg-[#333]"
				required />
		</div>
		<div>
			<label>Description</label>
			<textarea
				v-model="animal.description"
				class="w-full p-2 rounded bg-[#333]"></textarea>
		</div>
		<div>
			<label>Prix (€)</label>
			<input
				v-model="animal.price"
				type="number"
				step="0.01"
				class="w-full p-2 rounded bg-[#333]"
				required />
		</div>
		<div class="flex items-center space-x-2">
			<input
				id="isAvailable"
				type="checkbox"
				v-model="animal.isAvailable"
				class="w-4 h-4 text-green-600 bg-gray-700 border-gray-600 rounded focus:ring-green-500" />
			<label for="isAvailable" class="text-sm"> Disponible </label>
		</div>
		<div>
			<label>Type</label>
			<select
				v-model="animal.type"
				class="w-full p-2 rounded bg-[#333]"
				required>
				<option
					v-for="type in types"
					:key="type.id"
					:value="`/api/types/${type.id}`">
					{{ type.name }}
				</option>
			</select>
		</div>
		<div>
			<label>Race</label>
			<select
				v-model="animal.breed"
				class="w-full p-2 rounded bg-[#333]"
				required>
				<option
					v-for="breed in breeds"
					:key="breed.id"
					:value="`/api/breeds/${breed.id}`">
					{{ breed.name }}
				</option>
			</select>
		</div>

		<button
			type="submit"
			:disabled="isSubmitting"
			class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
			{{ isSubmitting ? "Enregistrement..." : "Enregistrer les modifications" }}
		</button>
	</form>
</template>
