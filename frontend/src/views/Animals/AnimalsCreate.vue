<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

const router = useRouter();

const form = ref({
	name: "",
	age: null,
	description: "",
	price: null,
	isAvailable: false,
	typeId: null,
	breedId: null,
});

const types = ref([]);
const breeds = ref([]);

const errorMessage = ref("");
const isLoading = ref(false);

const fetchTypes = async () => {
	try {
		const res = await axios.get(`${API_BASE_URL}/types`);
		types.value = res.data["member"] || [];
	} catch (error) {
		console.error("Erreur récupération types :", error);
	}
};

const fetchBreeds = async () => {
	try {
		const res = await axios.get(`${API_BASE_URL}/breeds`);
		breeds.value = res.data["member"] || [];
	} catch (error) {
		console.error("Erreur récupération races :", error);
	}
};

onMounted(() => {
	fetchTypes();
	fetchBreeds();
});

const submitForm = async () => {
	errorMessage.value = "";
	isLoading.value = true;

	const payload = {
		name: form.value.name,
		age: form.value.age,
		description: form.value.description,
		price: form.value.price,
		isAvailable: form.value.isAvailable,
		type: `/api/types/${form.value.typeId}`,
		breed: `/api/breeds/${form.value.breedId}`,
	};

	try {
		const response = await axios.post(`${API_BASE_URL}/animals`, payload);
		console.log("Animal créé :", response.data);
		router.push("/");
	} catch (error) {
		console.error("Erreur création animal :", error);
		errorMessage.value = "Une erreur est survenue lors de la création.";
	} finally {
		isLoading.value = false;
	}
};
</script>

<template>
	<h1 class="text-4xl text-[rgb(232,232,232)] font-bold mb-6">
		Ajouter un nouvel animal
	</h1>

	<form
		@submit.prevent="submitForm"
		class="max-w-md space-y-4 bg-[#222222] p-6 rounded-xl text-[rgb(232,232,232)]">
		<div>
			<label for="name" class="block mb-1 font-bold">Nom</label>
			<input
				id="name"
				v-model="form.name"
				type="text"
				required
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]" />
		</div>

		<div>
			<label for="age" class="block mb-1 font-bold">Âge</label>
			<input
				id="age"
				v-model.number="form.age"
				type="number"
				min="0"
				required
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]" />
		</div>

		<div>
			<label for="description" class="block mb-1 font-bold">Description</label>
			<textarea
				id="description"
				v-model="form.description"
				rows="3"
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]"></textarea>
		</div>

		<div>
			<label for="price" class="block mb-1 font-bold">Prix HT(€)</label>
			<input
				id="price"
				v-model.number="form.price"
				type="number"
				min="0"
				step="0.01"
				required
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]" />
		</div>

		<div class="flex items-center space-x-2">
			<input
				id="isAvailable"
				v-model="form.isAvailable"
				type="checkbox"
				class="w-5 h-5 rounded border border-gray-600 bg-[#333] text-[hsla(160,100%,37%,1)] focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]" />
			<label for="isAvailable" class="font-bold select-none">Disponible</label>
		</div>

		<div>
			<label for="type" class="block mb-1 font-bold">Type</label>
			<select
				id="type"
				v-model.number="form.typeId"
				required
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]">
				<option disabled value="">Sélectionnez un type</option>
				<option v-for="type in types" :key="type.id" :value="type.id">
					{{ type.name }}
				</option>
			</select>
		</div>

		<div>
			<label for="breed" class="block mb-1 font-bold">Race</label>
			<select
				id="breed"
				v-model.number="form.breedId"
				required
				class="w-full p-2 rounded border border-gray-600 bg-[#333] text-white focus:outline-none focus:ring-2 focus:ring-[hsla(160,100%,37%,1)]">
				<option disabled value="">Sélectionnez une race</option>
				<option v-for="breed in breeds" :key="breed.id" :value="breed.id">
					{{ breed.name }}
				</option>
			</select>
		</div>

		<button
			type="submit"
			:disabled="isLoading"
			class="w-full bg-[hsla(160,100%,37%,1)] text-white font-bold py-2 rounded-lg hover:bg-[hsla(160,100%,37%,0.8)] transition-colors disabled:opacity-50">
			{{ isLoading ? "Envoi..." : "Créer" }}
		</button>

		<p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
	</form>
</template>
