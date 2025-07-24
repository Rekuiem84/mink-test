<script setup>
const props = defineProps({
	animal: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<div class="bg-[#222222] text-[rgb(232,232,232)] p-4 rounded-xl relative">
		<h2 class="font-bold mb-2 text-2xl">{{ props.animal.name }}</h2>
		<p class="mt-2"><strong>Type :</strong> {{ props.animal.type.name }}</p>
		<p class="mt-2"><strong>Race :</strong> {{ props.animal.breed.name }}</p>
		<p class="mt-2"><strong>Âge :</strong> {{ props.animal.age }} ans</p>
		<p class="mt-2">
			<strong>Description :</strong> {{ props.animal.description }}
		</p>
		<p class="mt-2"><strong>Prix :</strong> {{ props.animal.price }} €</p>
		<p class="mt-2">
			<strong>Disponibilité:</strong>
			{{ props.animal.isAvailable ? "Oui" : "Non" }}
		</p>
	</div>
</template>
