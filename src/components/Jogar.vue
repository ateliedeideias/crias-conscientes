<template>
  <div>
    <md-dialog :md-active="inicioFase || exibirPerguntas || fimFase" :md-fullscreen="false" :md-close-on-esc="false" :md-click-outside-to-close="false">
      <IniciarFase
        v-if="inicioFase"
        @jogar="jogar" />

      <Pergunta
        v-if="exibirPerguntas"
        :perguntas="perguntasAleatorias"        
        @fimPerguntas="fimPerguntas"
      />

      <FimFase 
        v-if="fimFase"
        :nivel="nivel"
        :personagem="personagem"
        :apelido="apelidoUsuario"
        :totalAcertos="totalAcertos"
        @proximaFase="proximaFase"
      />
    </md-dialog>

    <Game :key="gameKey" :nivel="nivel" :bus="gameBus" @recebeDadosNunu="recebeDadosNunu" />
  </div>
</template>

<script>
import jsonPerguntas from "../assets/dados/perguntas.json";
import IniciarFase from "./IniciarFase.vue";
import FimFase from "./FimFase.vue";
import Vue from 'vue';
import Game from "./Game.vue";
import Pergunta from "./Pergunta.vue";


export default {
  name: "Jogar",
  components: {
    IniciarFase,
    Pergunta,
    FimFase,
     Game
  },
  data() {
    return {            
      perguntas: jsonPerguntas,
      gameKey: 1,
      nivel: 1,
      origem: "futebol",
      totalPerguntas: 3,
      personagemIniciado: false,
      inicioFase: false,
      exibirPerguntas: false,
      fimFase: false,
      totalAcertos: 0,
      apelidoUsuario: null,
      personagem: null,
      gameBus: new Vue(),  
    };
  },
  mounted() {
    document.addEventListener("backbutton", this.botaoVoltar, false);
  },
  beforeDestroy () {
    document.removeEventListener("backbutton", this.botaoVoltar);
  },
  computed: {
    perguntasValidas: function () {
      return this.perguntas.filter(
        (p) => p.nivel === this.nivel && p.origem === this.origem
      );
    },
    perguntasAleatorias: function () {
      const controlePerguntas = [];
      const perguntas = [];
      const maximo = this.perguntasValidas.length;
      const maximoPerguntas =
        this.perguntasValidas.length > this.totalPerguntas
          ? this.totalPerguntas
          : this.perguntasValidas.length;

      while (perguntas.length < maximoPerguntas) {
        const aleatorio = Math.random();
        const numeroFinal = Math.floor(aleatorio * maximo);

        if (controlePerguntas.indexOf(numeroFinal) === -1) {
          perguntas.push(this.perguntasValidas[numeroFinal]);
          controlePerguntas.push(numeroFinal);
        }
      }
      return perguntas;
    },
  },
  methods: {
    recebeDadosNunu(data) {
      if (this.fimFase) return false;
      
      console.log(data);
      this.nivel = data.nivel; // nunu deve informar a fase (Número)
      this.origem = data.type; // nunu deve informar a origem (lixeira, brecho, parquinho, etc....)

      switch (this.origem) {
        case "inicio":
          if (this.personagemIniciado) return;

          if (!this.personagem)
            this.inicioFase = true;
          else
            this.enviaPersonagem();

          this.personagemIniciado = true;
          break;
        case "fim":
          this.fimFase = true;
          break;        
        default:
          this.exibirPerguntas = true;
          break;
      }      
    },

    fimPerguntas(totalAcertos) {
      console.log("Esconder dialogo");
      this.exibirPerguntas = false;
      this.totalAcertos += totalAcertos;
      this.gameBus.$emit('sendData', {
        type: this.origem,
        nivel: this.nivel,
        count: totalAcertos,
      });
    },

    botaoVoltar() {
      this.$router.go("/");
    },

    jogar(personagem, apelidoUsuario) {
      console.log('Personagem selecionado', personagem);
      if (!personagem) {
        console.error('Personagem inválido!');
        return;
      }

      this.apelidoUsuario = apelidoUsuario;
      this.personagem = personagem;
      this.inicioFase = false;
      this.enviaPersonagem();
    },

    enviaPersonagem() {
      this.gameBus.$emit('sendData', {
        type: 'personagem',
        nivel: this.nivel,
        personagem: this.personagem.codigo,
      });
    },

    proximaFase() {
      this.nivel = this.nivel + 1;
      this.fimFase = false;
      this.totalAcertos = 0;      
      this.personagemIniciado = false;
      this.gameKey++;
    }
  },
};
</script>
