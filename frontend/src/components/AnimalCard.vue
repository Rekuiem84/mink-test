<script setup>
const props = defineProps({
	animal: {
		type: Object,
		required: true,
	},
});
</script>

<template>
	<div class="animal-card">
		<h2>{{ animal.name }}</h2>
		<p>Type: {{ animal.type.name }}</p>
		<p>Breed: {{ animal.breed.name }}</p>
	</div>
</template>

<style scoped>
.animal-card {
	background: #272727;
	color: rgb(240, 240, 240);
	padding: 1rem;
	border-radius: 1rem;
	margin-bottom: 1rem;
}
</style>
