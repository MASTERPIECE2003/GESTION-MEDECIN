<template>
  <div class="container mt-4">
    <div class="card w-75 mx-auto">
      <div class="card-header">
        <h4>
          LISTE DES MEDECINS
          <router-link to="/medecin/create" class="btn btn-primary float-end">AJOUTER MEDECINS</router-link>
        </h4>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th style="text-align: center;">ID</th>
              <th style="text-align: center;">NOM</th>
              <th style="text-align: center;">NOMBRE JOURS</th>
              <th style="text-align: center;">TAUX JOURNALIER</th>
              <th style="text-align: center; width: 200px;">PRESTATION</th>
              <th style="text-align: center; width: 200px;">ACTION</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="medecin in medecinlist.medecins">
              <td style="text-align: center;">{{ medecin.numed }}</td>
              <td style="text-align: center;">{{ medecin.nom }}</td>
              <td style="text-align: center;">{{ medecin.nombre_jours }}</td>
              <td style="text-align: center;">{{ medecin.taux_journalier }}</td>
              <td style="text-align: center;">{{ calculerPrestation(medecin) }}</td>
              <td style="text-align: center;">
                <button class="btn btn-success">Modifier</button>
                <button class="btn btn-danger ms-2" @click="deleteMedecin(medecin)">Supprimer</button>
              </td>
            </tr>
          </tbody>
        </table>

        <div style="border: 1px solid rgb(228, 225, 225); padding: 10px;">
          <div class="row mb-2">
            <div class="col-4">
              <h5 class="mb-2 text-center ml-2">TOTAL :</h5>
              <input type="text" name="total" id="total" class="form-control text-center" style="border: 1px solid rgb(216, 212, 212)" readonly v-model="total"/>
            </div>
            <div class="col-4">
              <h5 class="mb-2 text-center ml-2">MINIMUM :</h5>
              <input type="text" name="minimum" id="minimum" class="form-control text-center" style="border: 1px solid rgb(216, 212, 212)" readonly v-model="minimum"/>
            </div>
            <div class="col-4">
              <h5 class="mb-2 text-center ml-2">MAXIMUM :</h5>
              <input type="text" name="maximum" id="maximum" class="form-control text-center" style="border: 1px solid rgb(216, 212, 212)" readonly v-model="maximum"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      medecinlist: {
        medecins: []
      },
      total: 0,
      minimum: 0,
      maximum: 0
    };
  },
  mounted() {
    this.getAllMedecin();
  },
  methods: {
    getAllMedecin() {
      axios.get('http://localhost/PROJECT_VUE02/API/lireMedecin.php')
        .then(response => {
          if (response.data.error) {
            console.log('Erreur');
          }
          this.medecinlist = response.data;
          
          // Calcul du total, du minimum et du maximum des prestations
          this.total = this.medecinlist.medecins.reduce((acc, medecin) => {
            return acc + this.calculerPrestation(medecin);
          }, 0);

          this.minimum = Math.min(...this.medecinlist.medecins.map(medecin => this.calculerPrestation(medecin)));

          this.maximum = Math.max(...this.medecinlist.medecins.map(medecin => this.calculerPrestation(medecin)));
        })
        .catch(error => {
          console.error(error);
        });
    },
    deleteMedecin(medecin) {
      if (confirm('Voulez-vous vraiment supprimer ?')) {
        const { numed, nom, nombre_jours, taux_journalier } = medecin;
        axios
          .post('http://localhost/PROJECT_VUE02/API/supprimerMedecin.php', { numed, nom, nombre_jours, taux_journalier })
          .then(response => {
            alert(response.data.message);
            // Recharger la liste des médecins après la suppression
            this.getAllMedecin();
          })
          .catch(error => {
            console.error(error);
          });
      }
    },
    calculerPrestation(medecin) {
      return medecin.nombre_jours * medecin.taux_journalier;
    }
  }
};
</script>


