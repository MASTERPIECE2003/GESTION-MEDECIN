<template>
  <div class="container mt-4">
    <div class="card w-75 mx-auto">
      <div class="card-header">
        <h4>AJOUTER UN MEDECIN
        </h4>
      </div>

      <div class="card-body">
        <!-- Votre formulaire d'ajout ici -->
        <div class="form-group">
          <label for="nom">NOM</label>
          <input type="text" class="form-control" id="nom" v-model="user.nom">
        </div>
        <div class="form-group">
          <label for="nombre_jours">NOMBRE JOURS</label>
          <input type="text" class="form-control" id="nombre_jours" v-model="user.nombre_jours">
        </div>
        <div class="form-group">
          <label for="taux_journalier">TAUX JOURNALIER</label>
          <input type="text" class="form-control" id="taux_journalier" v-model="user.taux_journalier">
        </div>
      </div>

      <div class="card-footer">
        <button class="btn btn-primary float-start" style="text-align: left;">AJOUTER</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: {
        nom: '',
        nombre_jours: '',
        taux_journalier: ''
      }
    };
  },
  methods: {
    onFormSubmit() {
      console.log("Form submitted!");
      axios.post('http://localhost/PROJECT_VUE02/API/ajouterMedecin.php', {
        nom: this.user.nom,
        nombre_jours: this.user.nombre_jours,
        taux_journalier: this.user.taux_journalier
      })
        .then(response => {
          console.log(response.data);
          if (response.data.error) {
            console.log('Erreur');
            console.log(response.data.message);
          } else {
            console.log("Succès");
            console.log(response.data.message);
          }
        })
        .catch(error => {
          console.log('Erreur');
          console.log(error);
        });s
    }
  }
};
</script>
