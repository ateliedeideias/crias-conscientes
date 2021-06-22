<template>
  <div class="container">
    <img alt="Crias Conscientes" src="@/assets/logo.png" width="180" v-if="exibirDialogNumbero !== 4" />

    <div v-if="exibirDialogNumbero == 1"> 
      Sabe quando você deixa de comprar mais frutas no supermercado porque prefere consumir antes aquelas que já têm em casa?
      <br /><br />
      Ou quando abre mão de comprar por impulso uma roupa que você nem precisa?
      <br /><br />
      Você está consumindo de forma consciente, fazendo escolhas que vão ajudar a evitar o desperdício de comida e dinheiro. 
      <br /><br />

      <md-button class="botao" v-on:click="exibirDialogNumbero = 3">Acessar</md-button>

      <md-button class="botao" v-on:click="exibirDialogNumbero = 2">Cadastrar</md-button>

      <md-button class="botao" v-on:click="exibirDialogNumbero = 5">Jogar</md-button>
    </div>

    <Cadastrar v-if="exibirDialogNumbero === 2" @cadastrado="setarUsuario" @voltar="telaInicial"  />

    <Acessar v-if="exibirDialogNumbero === 3" @acessado="setarUsuario" @voltar="telaInicial" @cadastrar="exibirDialogNumbero = 2" />

    <SelecionarPersonagem v-if="exibirDialogNumbero === 4" @jogar="jogar" @voltar="telaInicial" />

    <div v-if="exibirDialogNumbero == 5"> 
      Deseja realmente jogar sem cadastro?
      <br /><br />
      <i>Dessa forma você não participará de nossas estatísticas e eventuais promoções do <b>Crias</b>.</i>
      <br /><br />

      <md-button class="botao" v-on:click="exibirDialogNumbero = 3">Acessar</md-button>

      <md-button class="botao" v-on:click="exibirDialogNumbero = 2">Cadastrar</md-button>

      <md-button class="botao" v-on:click="setarUsuario('(_#_#_anonimo_#_#_)')">Jogar</md-button>
    </div>
  </div>
</template>

<style scoped>
.container {
  color:#000000;
  background-color: #00d0c2;
  padding: 10px;
  margin-right: 0px;
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

.container img {
  margin-bottom: 15px;
}
</style>

<script>
import Acessar from './Acessar.vue';
import Cadastrar from './Cadastrar.vue';
import SelecionarPersonagem from './SelecionarPersonagem.vue';

export default {
    name: 'IniciarFase',
    components: {
      Acessar,
      Cadastrar,
      SelecionarPersonagem
    },
    data() {
      return {
        /*
        1. Mensagem de boas vindas.
        2. Formulário de cadastro.
        3. Formulário de acesso.
        4. Selecionar personagem.
        5. Confirma jogar sem cadastro.
        */
        exibirDialogNumbero: 1,
        apelidoUsuario: null,
      }
    },
    methods: {
      telaInicial() {
        this.exibirDialogNumbero = 1;
      },
      setarUsuario(usuario) {
        console.log("usuario informado", usuario);
        if (!usuario) {
          console.error("Usuário inválido!");
          this.exibirDialogNumbero = 1;
          return;
        }

        this.apelidoUsuario = usuario;
        this.exibirDialogNumbero = 4;
      },
      jogar(personagem) {
        this.$emit("jogar", personagem, this.apelidoUsuario);
      }     
    }    
}
</script>