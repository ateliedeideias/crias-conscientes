<template>
  <div>
    <div id="fullscreen" v-if="visible" v-on:click="fullscreen">
      <img alt="fullscreen" src="../assets/fullscreen.png" />
    </div>
    <div id="logo" class="md-center md-layout-item md-size-100" v-if="!visible">
      <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
      <p class="md-title">Carregando...</p>
    </div>
    <div id="rotate" class="md-title">Rotate</div>
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
      />
    </md-dialog>
    <canvas id="game"></canvas>
  </div>
</template>

<script>
import jsonPerguntas from "../assets/dados/perguntas.json";
import IniciarFase from "./IniciarFase.vue";
import Pergunta from "./Pergunta.vue";
import FimFase from "./FimFase.vue";

export default {
  name: "Jogar",
  components: {
    IniciarFase,
    Pergunta,
    FimFase
  },
  data() {
    return {
      app: {
        isLoad: false,
        resize: () => {
          return Promise.resolve();
        },
        loadRunProgram: () => {
          return Promise.resolve();
        },
        toggleFullscreen: () => {
          return Promise.resolve();
        },
      },
      nunu: require("../assets/nunu.min.njs"),
      visible: false,
      perguntas: jsonPerguntas,
      nivel: 1,
      origem: "futebol",
      totalPerguntas: 3,
      inicioFase: false,
      exibirPerguntas: false,
      fimFase: false,
      totalAcertos: 0,
      apelidoUsuario: null,
      personagem: null,
      faseGame: require("../assets/app1.nsp"),
    };
  },
  mounted() {
    document.addEventListener("backbutton", this.botaoVoltar, false);

    if (!this.app.isLoad) {
      let script = document.createElement("script");
      script.onload = async () => {
        let game = document.getElementById("game");
        this.app = new window.Nunu.App(game);
        this.app.isLoad = true;
        this.app.setOnDataReceived(this.recebeDadosNunu);
        await this.app.loadRunProgram(this.faseGame);
        this.visible = true;
      };
      script.async = true;
      script.src = this.nunu;
      document.head.appendChild(script);
      document.body.onresize = () => {
        console.log("Resize");
        this.app.resize();
      };
    }
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
    fullscreen(event) {
      event.preventDefault();
      this.app.toggleFullscreen(document.body);
    },
    recebeDadosNunu(data) {
      if (this.fimFase) return false;
      
      console.log(data);
      this.nivel = data.nivel; // nunu deve informar a fase
      this.origem = data.type; // nunu deve informar a origem (lixeira, brecho, parquinho, etc....)

      switch (this.origem) {
        case "inicio":
          if (!this.personagem) {
            this.inicioFase = true;
          }          
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
      this.app.sendData({
        type: this.origem,
        nivel: this.nivel,
        count: totalAcertos,
      });
    },

    botaoVoltar() {
      this.$router.go("/");
    },

    jogar(personagem, apelidoUsuario) {
      console.log("Personagem selecionado", personagem);
      if (!personagem) {
        console.error("Personagem inválido!");
        return;
      }

      this.apelidoUsuario = apelidoUsuario;
      this.personagem = personagem;
      this.inicioFase = false;
      this.app.sendData({
        type: "personagem",
        nivel: this.nivel,
        personagem: this.personagem.codigo,
      });
    }
  },
};
</script>

<style scoped>
#fullscreen {
  position: absolute;
  z-index: 10000;
  right: 40px;
  bottom: 40px;
  opacity: 0.4;
}
#fullscreen:hover {
  opacity: 1;
}
#fullscreen > img {
  cursor: pointer;
  opacity: 0.4;
  width: 25px;
  height: 25px;
}
#rotate {
  color: #ffffff;
  background-color: #222222;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  z-index: 20000;
  padding-top: 75%;
  text-align: center;
}
#game {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
}
@media screen and (orientation: portrait) {
  #game,
  #fullscreen,
  #logo {
    display: none;
  }
  #rotate {
    display: block;
  }
}
@media screen and (orientation: landscape) {
  #game,
  #fullscreen,
  #logo {
    display: block;
  }
  #rotate {
    display: none;
  }
}
</style>
