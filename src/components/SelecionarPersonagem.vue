<template>
  <div>
    <p>Selecione o seu personagem</p>

    <div class="flex-container">
      <div><md-button class="botao botao-personagem"  v-on:click="proximo(-1)">&lt;&lt;</md-button></div>

      <div class="personagem">        
        <img :src="getImgUrl()" v-bind:alt="personagem.nome"><br />
        <span :class="classePersonagem">{{personagem.nome}}</span>
      </div>

      <div><md-button class="botao botao-personagem" v-on:click="proximo(+1)">&gt;&gt;</md-button></div>
    </div>  
    <div class="botoes">
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

.personagem {
  min-width: 200px;
}

.personagem img {
  max-height: 180px;
}

.personagem span {
  text-decoration: underline;
}

.botao-personagem {
  margin-top: 65px;
  height: 55px !important;
  background-color: #ff6600 !important;
}

.botoes {
  padding-top: 10px;
}

.p1 {
  color: #aa00d4;
}

.p2 {
  color: #ff3000;
}

.p3 {
  color: #aa0000;
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
          imagem: "personagem1.png",
          class: "p1"
        },
        {
          codigo: 1,
          nome: "Bil",
          imagem: "personagem2.png",
          class: "p2"
        },
        {
          codigo: 3,
          nome: "Dandara",
          imagem: "personagem3.png",
          class: "p3"
        },
      ]
    }
  },
  computed: {
    personagem() { return this.personagens[this.personagemSelecionado]; },
    classePersonagem() { return this.personagem.class; },
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