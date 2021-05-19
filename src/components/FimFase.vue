<template>
  <div class="principal">
    <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />

    <p>{{textoFim}}</p>

    <p>Aguarde que em breve novas fases e desafios serão disponibilizados!</p>

    <md-button class="botao" v-on:click="jogarNovamente()">Jogar novamente</md-button>

    <router-link to="/team">
      <md-button class="botao">Sair</md-button>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "FimFase",
  props: ['totalAcertos'],
  computed: {
    textoFim: function() {
      if (this.totalAcertos == 15) return "Você acertou todas as 15 perguntas dessa fase. Você sabe tudo sobre consumo consciente.";
      if (this.totalAcertos >= 10) return `Você acertou a maioria das perguntas, ${this.totalAcertos} de 15. Você conhece um pouco sobre consumo consciente, mas ainda pode melhorar. Que tal jogar novamente e tentar melhorar seus acertos.`;
      if (this.totalAcertos >= 1) return `Você não acertou quase nada, ${this.totalAcertos} de 15. Jogue novamente e melhore sua pontuação`;

      return "Você não acertou nenhuma das 15 perguntas. Jogue novamente e melhore sua pontuação";
    }
  },
  methods: {
    jogarNovamente() {
      this.$router.go();
    }
  }
}
</script>

<style scoped>
.principal {
  color:#000;
  background-color: #00d0c2;
  padding: 10px;
  border-color: #000;    
  border-width: 3px; 
  border-bottom-width: 6px;   
  border-style: solid;
  border-radius: 10px;
  text-align: center;
  text-decoration-color: darkcyan;
  font-size: 20px;
  font-weight: bold;
  line-height: 25px;
  overflow: auto;    
}
</style>