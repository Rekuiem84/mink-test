import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AnimalsList from "@/views/Animals/AnimalsList.vue";

const router = createRouter({
	history: createWebHistory(import.meta.env.BASE_URL),
	routes: [
		{
			path: "/",
			name: "home",
			component: HomeView,
		},
		{
			path: "/animals",
			name: "animalsList",
			component: AnimalsList,
		},
	],
});

export default router;
