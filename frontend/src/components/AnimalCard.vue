<script setup>
defineProps({
	animal: {
		type: Object,
		required: true,
	},
});
</script>
<template>
	<div class="bg-[#222222] text-[rgb(232,232,232)] p-4 rounded-xl">
		<h2 class="font-bold mb-2 text-2xl">{{ animal.name }}</h2>
		<p class="mt-2"><strong>Type :</strong> {{ animal.type.name }}</p>
		<p class="mt-2"><strong>Race :</strong> {{ animal.breed.name }}</p>
		<p class="mt-2"><strong>Âge :</strong> {{ animal.age }} ans</p>
		<p class="mt-2"><strong>Description :</strong> {{ animal.description }}</p>
		<p class="mt-2"><strong>Prix :</strong> {{ animal.price }} €</p>
		<p class="mt-2">
			<strong>Disponibilité:</strong> {{ animal.isAvailable ? "Oui" : "Non" }}
		</p>
	</div>
</template>
