<template>
  <div> 
    <div v-if="!enviando">   
      <p>Bem vindo ao jogo, faça seu cadastro para poder jogar e salvar suas pontuações.</p>

      <p v-if="msgErro" v-html="msgErro" class='msg-erro'></p>

      <form novalidate class="md-layout" @submit.prevent="validarForm">
          <md-field :class="getValidationClass('apelido')">
            <label for="apelido">Apelido</label>
            <md-input name="apelido" id="apelido" autocomplete="apelido" v-model="form.apelido" />
            <span class="md-error" v-if="!$v.form.apelido.required">Por favor, informe seu apelido.</span>
            <span class="md-error" v-else-if="!$v.form.apelido.minlength">O apelido não pode ter menos do que 3 caracteres.</span>
          </md-field>

          <md-field :class="getValidationClass('email')">
            <label for="email">Email</label>
            <md-input name="email" id="email" autocomplete="email" v-model="form.email" />
            <span class="md-error" v-if="!$v.form.email.required">Por favor, informe seu email.</span>
            <span class="md-error" v-else-if="!$v.form.email.email">Por favor informe um email válido.</span>
          </md-field>

          <md-field :class="getValidationClass('telefone')">
            <label for="telefone">Telefone</label>
            <md-input name="telefone" id="telefone" autocomplete="telefone" v-model="form.telefone" />
            <span class="md-error" v-if="!$v.form.telefone.required">Por favor, informe seu telefone.</span>
            <span class="md-error" v-else-if="!$v.form.telefone.minLength">Por favor informe um telefone válido.</span>
          </md-field>

          <div class="campo">
            <md-switch v-model="form.possuiWhatsapp">Esse número possui Whatsapp.</md-switch>
          </div>

          <md-field :class="getValidationClass('senha')">
            <label for="senha">Senha</label>
            <md-input name="senha" id="senha" v-model="form.senha" type="password"></md-input>
            <span class="md-error" v-if="!$v.form.senha.required">Por favor, informe sua senha.</span>
            <span class="md-error" v-else-if="!$v.form.senha.minlength">A senha não pode ter menos do que 3 caracteres.</span>
          </md-field>

          <md-field :md-toggle-password="false" :class="getValidationClass('confirmarSenha')">
            <label for="confirmarSenha">Confirmar Senha</label>
            <md-input name="confirmarSenha" id="confirmarSenha" v-model="form.confirmarSenha" type="password"></md-input>
            <span class="md-error" v-if="!$v.form.confirmarSenha.igualSenha">As senhas estão diferentes.</span>
          </md-field>

          <div>
            <md-button type="submit" class="botao">Cadastrar</md-button>

            <md-button class="botao" v-on:click="voltar()">Voltar</md-button>
          </div>
      </form>
    </div>

    <div v-if="enviando">
      <md-progress-bar md-mode="indeterminate"></md-progress-bar>
      Por favor aguarde enquanto efetuamos seu cadastro!
    </div>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators';
import WebServices from '../webServices.js';

export default {
  name: 'Cadastrar',
  mixins: [validationMixin],
  data() {
    return {
      form: {
        apelido: null,
        email: null,
        telefone: null,
        possuiWhatsapp: null,
        senha: null,
        confirmarSenha: null,
      },
      enviando: false,
      msgErro: null,
    }
  },
  computed: {
    webServices() { return new WebServices() },
  },
  validations: {
    form: {
      apelido: {
        required,
        minLength: minLength(3)
      },
      email: {
        required,
        email
      },
      telefone: {
        required,
        minLength: minLength(9)
      },
      senha: {
        required,
        minLength: minLength(3)
      },
      confirmarSenha: {
        igualSenha: sameAs('senha')
      }
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
        this.cadastrar();
      }
    },
    cadastrar() {
      this.enviando = true;
      const parametros = {
        apelido: this.form.apelido,
        email: this.form.email,
        telefone: this.form.telefone,
        temWhats: this.form.possuiWhatsapp ? true : false,
        senha: this.form.senha
      }

      this.webServices.efetuarCadastro(parametros)
        .then(() => this.$emit("cadastrado", this.form.apelido))
        .catch((error) => {
          this.msgErro = `Ocorreu um erro ao tentar efetuar seu cadastro!<br />${error}`;
          this.enviando = false;          
        });
    },
    voltar() {
      this.$emit("voltar");
    }
  }
}
</script>

<style scoped>
.campo {
  text-align: left;
}
</style>