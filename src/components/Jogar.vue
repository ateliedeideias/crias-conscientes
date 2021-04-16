<template>
  <div>
    <div
      id="fullscreen"
      v-bind:class="{ visible: visible, invisible: !visible }"
      v-on:click="fullscreen"
    >
      <img alt="fullscreen" src="../assets/fullscreen.png" />
    </div>
    <div
      id="logo"
      class="md-center md-layout-item md-size-100"
      v-bind:class="{ visible: !visible, invisible: visible }"
    >
      <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
      <p class="md-title">Carregando...</p>
    </div>
    <div id="rotate">Rotate</div>
    <md-dialog :md-active.sync="exibirPerguntas" :md-fullscreen="false">
      <div class="pergunta">
        <Pergunta
          :perguntas="perguntasAleatorias"
          @fimPerguntas="fimPerguntas"
        />
      </div>
    </md-dialog>
  </div>
</template>

<script>
import Pergunta from "./Pergunta.vue";
import jsonPerguntas from "../assets/dados/perguntas.json";

export default {
  name: "App",
  components: {
    Pergunta,
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
      game: require("../assets/app.nsp"),
      nunu: require("../assets/nunu.min.njs"),
      visible: false,
      perguntas: jsonPerguntas,
      nivel: 2,
      origem: "campodefutebol",
      totalPerguntas: 3,
      exibirPerguntas: false,
    };
  },
  mounted() {
    if (!this.app.isLoad) {
      let script = document.createElement("script");
      script.onload = async () => {
        this.app = new window.Nunu.App();
        this.app.isLoad = true;
        this.app.setOnDataReceived(this.dialog);
        await this.app.loadRunProgram(this.game);
        this.visible = true;
      };
      script.async = true;
      script.src = this.nunu;
      document.head.appendChild(script);
      document.body.onresize = () => {
        this.app.resize();
      };
    }
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
      console.log("Maximo perguntas", maximoPerguntas);

      while (perguntas.length < maximoPerguntas) {
        const aleatorio = Math.random();
        const numeroFinal = Math.floor(aleatorio * maximo);
        console.log("Numero final", numeroFinal);

        if (controlePerguntas.indexOf(numeroFinal) === -1) {
          console.log("Aleatório", numeroFinal);
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
    dialog(data) {
      console.log(data);
      //this.nivel = data.nivel; // nunu deve informar a fase
      //this.origem = data.origem; // nunu deve informar a origem (lixeira, brecho, parquinho, etc....)
      this.exibirPerguntas = true;
    },

    fimPerguntas(totalAcertos) {
      console.log("Esconder dialogo");
      this.exibirPerguntas = false;
      this.app.sendData({
        number: this.nivel,
        count: totalAcertos,
      });
    },
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
  position: absolute;
  width: 100%;
  top: 50%;
  text-align: center;
}
@media screen and (orientation: portrait) {
  canvas,
  #fullscreen,
  #logo {
    display: none;
  }
  #rotate {
    display: block;
  }
}
@media screen and (orientation: landscape) {
  canvas,
  #fullscreen,
  #logo {
    display: block;
  }
  #rotate {
    display: none;
  }
}
</style>
