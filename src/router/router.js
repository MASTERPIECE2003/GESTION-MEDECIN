

import { createWebHistory, createRouter } from "vue-router";
import AjoutMedecin from "../views/Medecins/AjoutMedecin.vue";
import MedecinView from "../views/Medecins/View.vue";

const routes = [
  {
    path: "/medecins",
    name: "medecins",
    component: MedecinView,
  },
  
  {
    path: "/medecin/create",
    name: "ajoutMedecin",
    component: AjoutMedecin,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
