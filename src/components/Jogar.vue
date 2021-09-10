<template>
  <div>
    <md-dialog :md-active="inicioFase || exibirPerguntas || fimFase || loading" :md-fullscreen="false" :md-close-on-esc="false" :md-click-outside-to-close="false">
      <Carregando v-if="loading" :texto="textoLoading" />
      
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
        :ultimoNivel="ultimoNivel"
        :personagem="personagem"
        :apelido="apelidoUsuario"
        :totalAcertos="totalAcertos"
        :totalPerguntas="perguntasNivel.length"
        :uuidPartida="uuidPartida"
        :dataInicioPartida="dataPartida"
        @proximaFase="proximaFase"
      />
    </md-dialog>

    <Game 
      :key="gameKey"
      :nivel="nivel"
      :totalPontuacao="pontuacaoTotal"
      :bus="gameBus"
      :dataInicio="dataPartida"
      :fimFase="fimFase"
      @recebeDadosNunu="recebeDadosNunu" />
  </div>
</template>

<script>
import jsonPerguntas from "../assets/dados/perguntas.json";
import Game from "./Game.vue";
import Carregando from "./Carregando.vue";
import IniciarFase from "./IniciarFase.vue";
import Pergunta from "./Pergunta.vue";
import FimFase from "./FimFase.vue";
import Vue from 'vue';
import WebServices from '../webServices.js';

export default {
  name: "Jogar",
  components: {
    Carregando,
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
      ultimoNivel: 9,
      origem: "",
      totalPerguntas: 2,
      personagemIniciado: false,
      inicioFase: false,
      exibirPerguntas: false,
      fimFase: false,
      pontuacaoTotal: 0,
      totalAcertos: 0,
      apelidoUsuario: null,
      personagem: null,
      gameBus: new Vue(),  
      loading: false,
      textoLoading: "",
      uuidPartida: null,
      dataPartida: null,
    };
  },
  mounted() {
    document.addEventListener("backbutton", this.botaoVoltar, false);
  },
  beforeDestroy () {
    document.removeEventListener("backbutton", this.botaoVoltar);
  },
  computed: {
    perguntasNivel: function () {
      return this.perguntas.filter((p) => p.nivel === this.nivel);
    },
    perguntasValidas: function () {
      return this.perguntasNivel.filter((p) => p.origem === this.origem);
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
    webServices() { return new WebServices() },
  },
  methods: {
    recebeDadosNunu(data) {
      if (this.fimFase) return false;
      
      //console.log(data);
      this.nivel = data.nivel; // nunu deve informar a fase
      this.origem = data.type; // nunu deve informar a origem (lixeira, brecho, parquinho, etc....)

      switch (this.origem) {
        case "inicio":
          if (this.personagemIniciado) return;

          if (!this.personagem) {
            this.inicioFase = true;
            return;
          }

          this.personagemIniciado = true;
          this.enviaPersonagem();                    
          this.dataPartida = new Date();
          //console.log('Iniciar partida', this.dataPartida);
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
      //console.log("Esconder dialogo");
      this.exibirPerguntas = false;
      this.totalAcertos += totalAcertos;
      this.pontuacaoTotal += totalAcertos;
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
      //console.log('Personagem selecionado', personagem);
      if (!personagem || personagem < 1 || personagem > 5) {
        console.error('Personagem inválido!');
        return;
      }

      this.inicioFase = false;

      if (apelidoUsuario && apelidoUsuario !== '(_#_#_anonimo_#_#_)') {
        this.criarPartida(personagem, apelidoUsuario)
        return;
      }      
      
      this.iniciarPartida(personagem, apelidoUsuario);
    },

    iniciarPartida(personagem, apelidoUsuario) {
      this.apelidoUsuario = apelidoUsuario;
      this.personagem = personagem;
      this.totalAcertos = 0;
      this.pontuacaoTotal = 0;

      /*if (this.nivel === 1) {
        this.totalAcertos = 11;
        this.fimFase = true;
        return;
      }*/

      this.enviaPersonagem();
    },

    criarPartida(personagem, apelidoUsuario) {
      this.loading = true;
      this.textoLoading = "Espera aí só um pouco. Estamos criando sua partida.";
        
      const parametros = {
        apelido: apelidoUsuario,
        personagem: personagem.codigo,
      };

      this.webServices.criarPartida(parametros)
        .then(({data}) => {
          //console.log('Uuid partida', data);
          this.uuidPartida = data;
          this.iniciarPartida(personagem, apelidoUsuario);
        })
        .catch((error) => {
          console.error('Erro ao criar partida.', error);
        })
        .finally(() => {
          this.loading = false;
        });
    },

    enviaPersonagem() {
      if (!this.nivel || !this.personagem) return;
      
      //console.log('Envia personagem', this.nivel, this.personagem.codigo);

      this.gameBus.$emit('sendData', {
        type: 'personagem',
        nivel: this.nivel,
        personagem: this.personagem.codigo,
      });

      //console.log('Personagem enviado');
    },

    proximaFase() {
      this.nivel = this.nivel + 1;
      //console.log('Proxima fase ' + this.nivel);
      this.fimFase = false;
      this.totalAcertos = 0;
      this.dataPartida = null;      
      this.personagemIniciado = false;
      this.gameKey++;
    }
  },
};
</script>
