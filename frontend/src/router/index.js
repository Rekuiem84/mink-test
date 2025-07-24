import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AnimalsList from "@/views/Animals/AnimalsList.vue";
import AnimalsCreate from "@/views/Animals/AnimalsCreate.vue";
import AnimalsDetails from "@/views/Animals/AnimalsDetails.vue";
import AnimalsEdit from "@/views/Animals/AnimalsEdit.vue";

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
		{
			path: "/animals/:id",
			name: "animalsDetails",
			component: AnimalsDetails,
		},
		{
			path: "/animals/new",
			name: "animalsCreate",
			component: AnimalsCreate,
		},
		{
			path: "/animals/:id/edit",
			name: "animalsEdit",
			component: AnimalsEdit,
		},
	],
});

export default router;
