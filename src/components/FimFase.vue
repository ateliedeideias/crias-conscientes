<template>
  <div class="principal">
    <img alt="Crias Conscientes" src="@/assets/logo.png" width="180" />

    <p>{{textoFim}}</p>
    
    <p v-if="nivel >= ultimoNivel">Você finalizou o jogo Crias Conscientes! Obrigado por jogar.</p>    

    <p v-if="msgErro" v-html="msgErro" class='msg-erro'></p>

    <div v-if="!salvando">
      <md-button class="botao" v-on:click="proximaFase()" v-if="nivel < ultimoNivel">Próxima Fase</md-button>

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
  props: ['totalAcertos', 'nivel', 'ultimoNivel', 'personagem', 'apelido', 'totalPerguntas'],
  data() {
    return {
      salvando: true,
      aviso: false,
      msgErro: null,
    }
  },
  computed: {
    porcentoAcertos: function() {
      return (100 * this.totalAcertos) / this.totalPerguntas;
    },
    textoFim: function() {
      if (this.porcentoAcertos === 100) return `Você acertou todas as ${this.totalPerguntas} perguntas dessa fase. Você sabe tudo sobre consumo consciente.`;
      else if (this.porcentoAcertos > 50) return `Você acertou a maioria das perguntas, ${this.totalAcertos} de ${this.totalPerguntas}. Você conhece um pouco sobre consumo consciente, mas ainda pode melhorar. Que tal jogar novamente e tentar melhorar seus acertos.`;
      else if (this.porcentoAcertos === 50) return `Você acertou a metade das perguntas, ${this.totalAcertos} de ${this.totalPerguntas}. Que tal jogar novamente e tentar melhorar seus acertos.`;
      else if (this.porcentoAcertos > 0) return `Você não acertou quase nada, ${this.totalAcertos} de ${this.totalPerguntas}. Jogue novamente e melhore sua pontuação`;

      return `Você não acertou nenhuma das ${this.totalPerguntas} perguntas. Jogue novamente e melhore sua pontuação`;
    },
    webServices() { return new WebServices() },
  },
  created: function () {
    if (this.apelido === "(_#_#_anonimo_#_#_)") {
      this.salvando = false;
      this.aviso = true;
      return;
    }
    this.salvando = true;

    //console.log("Salvar pontuacao");
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