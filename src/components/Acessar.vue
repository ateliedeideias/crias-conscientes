<template>
<div> 
    <div v-if="!enviando">   
      <p>Informe seu usuário e senha para poder jogar.</p>

      <p v-if="msgErro" v-html="msgErro" class='msg-erro'></p>

      <form novalidate class="md-layout" @submit.prevent="validarForm">
          <md-field :class="getValidationClass('usuario')">
            <label for="usuario">Apelido ou e-mail</label>
            <md-input name="usuario" id="usuario" autocomplete="usuario" v-model="form.usuario" />
            <span class="md-error" v-if="!$v.form.usuario.required">Por favor, informe seu apelido ou e-mail cadastrados no jogo.</span>
          </md-field>
          
          <md-field :class="getValidationClass('senha')">
            <label for="senha">Senha</label>
            <md-input name="senha" id="senha" v-model="form.senha" type="password"></md-input>
            <span class="md-error" v-if="!$v.form.senha.required">Por favor, informe sua senha.</span>
          </md-field>          
          
          <div>
            <md-button type="submit" class="botao">Acessar</md-button>

            <md-button class="botao" v-on:click="voltar()">Voltar</md-button>

            <md-button class="botao" v-on:click="cadastrar()">Cadastrar</md-button>
          </div>
      </form>            
    </div>

    <div v-if="enviando">
      <md-progress-bar md-mode="indeterminate"></md-progress-bar>
      Por favor aguarde enquanto processamos seu acesso.
    </div>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required } from 'vuelidate/lib/validators';
import WebServices from '../webServices.js';

export default {
  name: 'Acessar',
  mixins: [validationMixin],
  data() {
    return {
      enviando: false,
      msgErro: null,
      form: {
        usuario: null,
        senha: null
      }
    }
  },
  computed: {
    webServices() { return new WebServices() },
  },
  validations: {
    form: {
      usuario: { required },      
      senha: { required },
    }
  },
  methods: {
    getValidationClass (fieldName) {
      const field = this.$v.form[fieldName]

      if (field) {
        return {
          'md-invalid': field.$invalid && field.$dirty
        }
      }
    },
    validarForm() {
      this.msgErro = null;
      this.$v.$touch();

      if (!this.$v.$invalid) {
        this.acessar();
      }
    },
    acessar() {
      this.enviando = true;
      const parametros = {
        usuario: this.form.usuario,
        senha: this.form.senha
      }

      this.webServices.acessar(parametros)
        .then((resultado) => this.$emit("acessado", resultado.data))
        .catch((error) => {
          if (error.response && error.response.status === 401) {
            this.msgErro = "Usuário ou senha incorretos.";
            this.form.senha = null;
          } else {
            this.msgErro = `Ocorreu um erro ao tentar efetuar seu acesso no jogo!<br />${error}`;
          }
                    
          this.enviando = false;          
        });
    },
    voltar() {
      this.$emit("voltar");
    },
    cadastrar() {
      this.$emit("cadastrar");
    }
  }
}
</script>