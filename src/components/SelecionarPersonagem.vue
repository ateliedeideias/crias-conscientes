<template>
  <div>
    <p>Selecione o seu personagem</p>

    <div class="flex-container">
      <div><md-button class="botao botao-personagem"  v-on:click="proximo(-1)">&lt;&lt;</md-button></div>

      <div class='personagem'>        
        <img :src="getImgUrl()" v-bind:alt="personagem.nome"><br />
        <span>{{personagem.nome}}</span>
      </div>

      <div><md-button class="botao botao-personagem" v-on:click="proximo(+1)">&gt;&gt;</md-button></div>
    </div>  
    <div>
      <md-button class="botao" v-on:click="jogar()">Jogar</md-button>

      <md-button class="botao" v-on:click="voltar()">Voltar</md-button>
    </div>  
  </div>  
</template>

<style scoped>
.flex-container {
  display: flex;
  flex-wrap: nowrap;
}

.personagem img {
  max-height: 200px;
}

.botao-personagem {
  height: 50px !important;
  background-color: #ff6600 !important;
}
</style>

<script>
export default {
  name: "SelecionarPersonagem",
  data() {
    return {
      personagemSelecionado: 0,
      personagens: [
        {
          codigo: 2,
          nome: "Jefin",
          imagem: "personagem-1.png"
        },
        {
          codigo: 3,
          nome: "Dandara",
          imagem: "personagem-2.png"
        },
        {
          codigo: 1,
          nome: "Bil",
          imagem: "personagem-3.png"
        },
      ]
    }
  },
  computed: {
    personagem() { return this.personagens[this.personagemSelecionado]; },
  },
  methods: {
    proximo(soma) {
      const resultadoPersonagem = this.personagemSelecionado + soma;
      if (resultadoPersonagem < 0) {
        this.personagemSelecionado = this.personagens.length - 1;
        return;
      }

      if (resultadoPersonagem > this.personagens.length - 1) {
        this.personagemSelecionado = 0;
        return;
      }

      this.personagemSelecionado = resultadoPersonagem;
    },
    getImgUrl() {      
      return require('../assets/personagens/'+this.personagem.imagem);
    },
    jogar() {
      this.$emit("jogar", this.personagem);
    },
    voltar() {
      this.$emit("voltar");
    }
  }
}
</script>