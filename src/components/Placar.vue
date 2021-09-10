<template>
  <div class="md-layout md-alignment-center pagina-placar">
    <section id="team" class="md-layout-item md-size-100">
      <carregando-site texto="Buscando os melhores jogadores do crias." v-if="carregandoPlacarCrias" />
      
      <h1 class="md-center md-title branco" v-if="!carregandoPlacarCrias">
        <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
        <p v-if="possuiPlacarCrias">Melhores jogadores do Crias</p>
        <p v-if="!possuiPlacarCrias">Ninguém ainda conseguiu vencer o desafio do crias.</p>
      </h1>

      <div class="md-center branco" v-if="possuiPlacarCrias && !carregandoPlacarCrias">
        <table class="placar-crias">
          <tr>
            <th>Jogador</th>
            <th>Personagem</th>
            <th>Pontos</th>
            <th>Tempo</th>
          </tr>

          <tr v-for="(item, index) in placarCrias" :key="`placar-${index}`">
            <td><b>{{item.apelido}}</b></td>
            <td><img :src="getImgUrl(item.personagem)" :title="getNomePersonagem(item.personagem)" class="img-personagem"></td>
            <td>{{item.pontos}}</td>
            <td>{{montaTextoTempo(item.tempo)}}</td>
          </tr>
        </table>
      </div>      
    </section>

    <section
      v-for="fase in fases"
      :key="fase.codigo"
      class="member md-center md-layout-item md-xlarge-size-50 md-large-size-50 md-medium-size-50 md-small-size-100 md-xsmall-size-100"
    >
      <carregando-site :texto="`Buscando os melhores jogadores de ${fase.nome}.`" v-if="fase.carregandoPlacar" />
      
      <h1 class="md-center md-title" v-if="!fase.carregandoPlacar">
        <img :alt="fase.nome" :src="getImgFaseUrl(fase.codigo)" width="256" />
        <p v-if="fase.possuiPlacar">Melhores jogadores do {{fase.nome}}</p>
        <p v-if="!fase.possuiPlacar">Ninguém ainda conseguiu vencer o desafio do {{fase.nome}}.</p>
      </h1>

      <div class="md-center" v-if="fase.possuiPlacar && !fase.carregandoPlacar">
        <table class="placar-fase">
          <tr>
            <th>Jogador</th>
            <th>Personagem</th>
            <th>Pontos</th>
            <th>Tempo</th>
          </tr>

          <tr v-for="(item, index) in fase.placar" :key="`placar-${index}`">
            <td><b>{{item.apelido}}</b></td>
            <td><img :src="getImgUrl(item.personagem)" :title="getNomePersonagem(item.personagem)" class="img-personagem"></td>
            <td>{{item.pontos}}</td>
            <td>{{montaTextoTempo(item.tempo)}}</td>
          </tr>
        </table>
      </div>   
    </section>
  </div>
</template>

<style scoped>
.pagina-placar {
  background-color: #fff;
}

table.placar-crias {
  margin-left: auto;
  margin-right: auto;  
}

table.placar-crias th {
  padding: 5px 20px 5px 20px;
  background-color: #001112;
}

table.placar-crias td {
  padding: 5px;  
}

table.placar-crias tr:nth-child(odd){
  background-color: #00191a;
}

table.placar-crias tr:nth-child(even){
  background-color: #2d2d2d;
}

table.placar-fase {
  margin-left: auto;
  margin-right: auto;  
}

table.placar-fase th {
  padding: 5px 20px 5px 20px;
  background-color: #c15c6b;
}

table.placar-fase td {
  padding: 5px;  
}

table.placar-fase tr:nth-child(odd){
  background-color: #f0e5ff;
}

table.placar-fase tr:nth-child(even){
  background-color: #d7d7d7;
}

.img-personagem {
  display: block;
  max-width:50px;
  max-height:100px;
  width: auto;
  height: auto;
  margin-left: auto;
  margin-right: auto;
}

#team {
  background-color: #222222 !important;
}
</style>

<script>
import CarregandoSite from './CarregandoSite.vue'
import WebServices from '../webServices.js';

export default {
  components: { CarregandoSite },
  name: 'Placar',  
  data() {
    return {
      placarCrias: [],
      carregandoPlacarCrias: true,
      possuiPlacarCrias: false,
      personagens: [
        {
          codigo: 2,
          nome: "Jefin",
          imagem: "personagem-1.png",
          class: "p1"
        },
        {
          codigo: 3,
          nome: "Dandara",
          imagem: "personagem-2.png",
          class: "p2"
        },
        {
          codigo: 1,
          nome: "Bil",
          imagem: "personagem-3.png",
          class: "p3"
        },
        {
          codigo: 4,
          nome: "Lud",
          imagem: "personagem-4.png",
          class: "p4"
        },
        {
          codigo: 5,
          nome: "Helô",
          imagem: "personagem-5.png",
          class: "p5"
        }
      ],
      fases: [
        {
          codigo: 1,
          nome: 'Itararé',
          imagem: 'itarare.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 2,
          nome: 'Bairro da Penha',
          imagem: 'bairro-penha.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 3,
          nome: 'São Benedito',
          imagem: 'sao-benedito.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 4,
          nome: 'Gurigica',
          imagem: 'gurigica.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 5,
          nome: 'Consolação',
          imagem: 'consolacao.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 6,
          nome: 'Floresta',
          imagem: 'floresta.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 7,
          nome: 'Engenharia',
          imagem: 'engenharia.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 8,
          nome: 'Bonfim',
          imagem: 'bonfim.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },
        {
          codigo: 9,
          nome: 'Jaburu',
          imagem: 'jaburu.png',
          placar: [],
          carregandoPlacar: true,
          possuiPlacar: false,
        },        
      ]
    }
  },
  computed: {
    webServices() { return new WebServices() },
  },
  mounted() {
    this.carregarPlacarCrias();
    this.carregarPlacarFases();
  },
  methods: {
    carregarPlacarCrias() {
      this.carregandoPlacarCrias = true;
      this.webServices.consultaPlacar()
        .then(({data}) => {
          this.placarCrias = data;
          this.possuiPlacarCrias = this.carregandoPlacarCrias && this.placarCrias && this.placarCrias.length > 0;
        })
        .catch(err => {
          console.error("Erro ao consultar placar", err);
          this.placarCrias = [];
          this.possuiPlacarCrias = false;
        })
        .finally(() => this.carregandoPlacarCrias = false);
    },

    carregarPlacarFases() {
      for (var i = 0; i < this.fases.length; i++) {
        const fase = this.fases[i];
        fase.carregandoPlacar = true;
        fase.placar = [];
        this.webServices.consultaPlacar(fase.codigo)
          .then(({data}) => {
            fase.placar = data;
            fase.possuiPlacar = fase.carregandoPlacar && fase.placar && fase.placar.length > 0;
          })
          .catch(err => {
            console.error("Erro ao consultar placar da fase " + fase.nome, err);
            fase.placar = [];
            fase.possuiPlacar = false;
          })
          .finally(() => fase.carregandoPlacar = false);
      }
    },

    getImgUrl(idPersonagem) {      
      const personagem = this.personagens.find(x => x.codigo == idPersonagem);
      if (!personagem) return "";

      return require('../assets/personagens/'+personagem.imagem);
    },

    getImgFaseUrl(idFase) {      
      const fase = this.fases.find(x => x.codigo == idFase);
      if (!fase) return "";

      return require('../assets/cenarios/'+fase.imagem);
    },

    getNomePersonagem(idPersonagem) {
      const personagem = this.personagens.find(x => x.codigo == idPersonagem);
      if (!personagem) return "";

      return personagem.nome;
    },

    montaTextoTempo(tempo) {
      const minutos = tempo >= 60 ? Math.trunc(tempo / 60) : 0;
      const segundos = minutos > 0 ? tempo - (minutos * 60) : tempo;

      if (!minutos || minutos <= 0) return `${segundos}s`;
      if (!segundos || segundos <= 0) return `${minutos}m`;

      return `${minutos}m ${segundos}s`
    }
  }
}
</script>