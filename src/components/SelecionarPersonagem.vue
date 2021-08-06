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
  background: linear-gradient(180deg, #9ebd13 0%, #008552 100%) !important;
  background-color: #ff6600 !important;
}

.botoes {
  padding-top: 10px;
}

.p1 {
  background: linear-gradient(0deg, #00C9FF 0%, #92FE9D 100%);
  background-color: black;
  border-radius: 10px;
  color: rgb(0, 0, 0);
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Para o safari */
  transition-duration: 0.4s;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.p2 {
  background-color: #030303;
  background: linear-gradient(0deg, #00C9FF 0%, #92FE9D 100%);
  border-radius: 10px;
  color: #030303;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Para o safari */
  transition-duration: 0.4s;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.p3 {
  background-color: #030303;
  background: linear-gradient(0deg, #00C9FF 0%, #92FE9D 100%);
  border-radius: 10px;
  color: #030303;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Para o safari */
  transition-duration: 0.4s;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.p4 {
  background-color: #030303;
  background: linear-gradient(0deg, #00C9FF 0%, #92FE9D 100%);
  border-radius: 10px;
  color: #030303;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Para o safari */
  transition-duration: 0.4s;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}

.p5 {
  background-color: #030303;
  background: linear-gradient(0deg, #00C9FF 0%, #92FE9D 100%);
  border-radius: 10px;
  color: #030303;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Para o safari */
  transition-duration: 0.4s;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
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
          nome: "JEFIN",
          imagem: "personagem1.png",
          class: "p1"
        },
        {
          codigo: 1,
          nome: "BIL",
          imagem: "personagem2.png",
          class: "p2"
        },
        {
          codigo: 3,
          nome: "DANDARA",
          imagem: "personagem3.png",
          class: "p3"
        },
        {
          codigo: 4,
          nome: "LUD",
          imagem: "personagem4.png",
          class: "p4"
        },
        {
          codigo: 5,
          nome: "HELO",
          imagem: "personagem5.png",
          class: "p5"
        }
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