<template>
  <div class="principal">
    <img alt="Crias Conscientes" src="@/assets/logo.png" width="180" />

    <p>{{textoFim}}</p>
    
    <p v-if="nivel > 1">Aguarde que em breve novas fases e desafios serão disponibilizados!</p>    

    <p v-if="msgErro" v-html="msgErro" class='msg-erro'></p>

    <div v-if="!salvando">
      <md-button class="botao" v-on:click="proximaFase()" v-if="nivel < 2">Próxima Fase</md-button>

      <md-button class="botao" v-on:click="jogarNovamente()">Jogar Novamente</md-button>

      <router-link to="/team">
        <md-button class="botao">Sair</md-button>
      </router-link>
    </div>

    <div v-if="aviso">
      <i>Você está jogando sem nenhum cadastro e sua pontuação não será salva.</i>
    </div>

    <div v-if="salvando">
      <md-progress-bar md-mode="indeterminate"></md-progress-bar>
      Por favor aguarde enquanto salvamos sua pontuação.
    </div>
  </div>
</template>

<script>
import WebServices from '../webServices.js';

export default {
  name: "FimFase",
  props: ['totalAcertos', 'nivel', 'personagem', 'apelido'],
  data() {
    return {
      salvando: true,
      aviso: false,
      msgErro: null,
    }
  },
  computed: {
    textoFim: function() {
        if (this.totalAcertos == 15) return "Você acertou todas as 15 perguntas desta fase. Você sabe tudo sobre consumo consciente.";
       if (this.totalAcertos >= 10) return `Você acertou a maioria das perguntas, ${this.totalAcertos} de 15. Você conhece um pouco sobre consumo consciente, mas ainda pode melhorar. Que tal jogar novamente e tentar melhorar seus acertos.`;
      if (this.totalAcertos >= 1) return `Você não acertou quase nada, ${this.totalAcertos} de 15. Jogue novamente e melhore sua pontuação`;

      return "Você não acertou nenhuma das 15 perguntas. Jogue novamente e melhore sua pontuação";
    },
    webServices() { return new WebServices() },
  },
  created: function () {
    if (this.apelido === "(_#_#_anônimo_#_#_)") {
      this.salvando = false;
      this.aviso = true;
      return;
    }
    this.salvando = true;

    console.log("Salvar pontuacao");
    const parametros = {
      apelido: this.apelido,
      fase: this.nivel,
      personagem: this.personagem.codigo,
      pontos: this.totalAcertos
    }

      this.webServices.salvarPontos(parametros)
      .catch((error) => this.msgErro = `Ocorreu um erro ao tentar salvar sua pontuação!<br />${error}`)
      .finally(() => this.salvando = false);
  },
  methods: {
    jogarNovamente() {
      this.$router.go();
    },
    proximaFase() {
      this.$emit('proximaFase');
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