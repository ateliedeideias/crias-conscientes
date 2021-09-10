<template>
  <div>
    <div id="relogio" v-if="visible && dataInicio">
      {{textoRelogio}}
    </div>

    <div id="pontuacao" v-if="visible && totalPontuacao > 0">
      {{totalPontuacao}}
    </div>

    <div id="fullscreen" v-if="visible" v-on:click="fullscreen">
      <img alt="fullscreen" src="../assets/fullscreen.png" />
    </div>
    <div id="logo" class="md-center md-layout-item md-size-100" v-if="!visible">
      <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
      <p class="md-title">Carregando...</p>
    </div>
    <div id="rotate" class="md-title">Rotate</div>
    
    <canvas id="game"></canvas>
  </div>
</template>

<script>
export default {
  name: "Game",
  props: ['nivel', 'bus', 'totalPontuacao', 'dataInicio'],
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
      textoRelogio: "",
      exibeSeparadorHora: true,
    }
  },
  beforeDestroy () {
    this.bus.$off('sendData', this.sendData);
  },
  mounted() {
    //console.log("Mounted");
    this.bus.$on('sendData', this.sendData);

    if (!this.app.isLoad) {
      var faseGame = require(`../assets/app${this.nivel}.nsp`);

      let script = document.createElement("script");
      script.onload = async () => {
        //console.log("Load game");
        let game = document.getElementById("game");
        this.app = new window.Nunu.App(game);
        this.app.isLoad = true;
        this.app.setOnDataReceived(this.recebeDadosNunu);
        await this.app.loadRunProgram(faseGame);
        this.visible = true;
      };
      script.async = true;
      script.src = this.nunu;
      document.head.appendChild(script);
      document.body.onresize = () => {
        //console.log("Resize");
        this.app.resize();
      };
    }

    this.$nextTick(function () {
          window.setInterval(() => {
              this.montaTextoRelogio();
          },1000);
      });
  },
  methods: {
    fullscreen(event) {
      event.preventDefault();
      this.app.toggleFullscreen(document.body);
    },

    recebeDadosNunu(data) {
      this.$emit('recebeDadosNunu', data);
    },

    sendData(params) {
      //console.log('sendData', params);
      this.app.sendData(params);
    },

    montaTextoRelogio() {
      if (!this.dataInicio) {
        this.textoRelogio = '';
        return;
      }

      const dataAtual = new Date();
      const diff = Math.trunc((dataAtual - this.dataInicio) / 1000);

      var minutos = diff > 60 ? Math.trunc(diff / 60) : 0;
      const segundos = diff - (minutos * 60);

      const separador = this.exibeSeparadorHora ? ':' : ' ';
      this.exibeSeparadorHora = !this.exibeSeparadorHora;

      this.textoRelogio = this.exibeValorHora(minutos) + separador + this.exibeValorHora(segundos);
    },

    exibeValorHora(valor) {
      if (valor < 10) {
        return `0${valor}`;
      }

      return `${valor}`;
    }
  }
}
</script>

<style scoped>
#pontuacao {
  position: absolute;
  z-index: 10000;
  right: 30px;
  top: 30px;
  font-size: 35pt;
  font-weight: bold;
  color: rgb(255, 238, 0);
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  background-color: rgba(0,0,0,0.3);
  padding: 15px;  
  border-radius: 10px;
}

#relogio {
  position: absolute;
  z-index: 10000;
  left: 30px;
  top: 30px;
  font-size: 25pt;
  font-weight: bold;
  color: #fff;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
  background-color: rgba(0,0,0,0.3);
  padding: 15px;  
  border-radius: 10px;
}

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