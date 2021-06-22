<template>
  <div id="app">
    <div id="header" v-if="visible">
      <md-tabs md-sync-route>
        <md-tab id="tab-home" md-label="Sobre o jogo" to="/" exact></md-tab>
        <md-tab id="tab-team" md-label="A equipe" to="/team"></md-tab>
      </md-tabs>
    </div>
    <router-view></router-view>
    <div
      id="footer"
      class="md-bottom-bar md-theme-default md-type-fixed"
      v-if="visible"
    >
      <p class="md-caption">Realização</p>
      <div class="barra-logos">
        <a href="https://www.instagram.com/ateliedeideias.es/" target="_blank">
          <img
            alt="Ateliê de Ideias"
            title="Ateliê de Ideias"
            src="@/assets/atelie.png"
            width="124"
            height="124"
          />
        </a>
        <a href="https://procon.vitoria.es.gov.br/" target="_blank" class="ml">
          <img
            alt="Procon Vitória"
            title="Procon de Vitória"
            src="@/assets/procon.png"
            width="124"
            height="124"
          />
        </a>
        <a href="https://www.vitoria.es.gov.br/" target="_blank" class="ml">
          <img
            alt="Prefeitura de Vitória"
            title="Prefeitura de Vitória"
            src="@/assets/prefeitura-vitoria.png"
            width="124"
            height="124"
          />
        </a>
      </div>      
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  metaInfo: {
    title: "Crias Conscientes",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      { "http-equiv": "X-UA-Compatible", content: "ie=edge" },
    ],
    link: [
      {
        rel: "favicon",
        href: require("./assets/favicon.png")
      },
      {
        rel: "icon",
        href: require("./assets/favicon.png")
      }
    ]
  },
  data() {
    return {
      visible: true,
    };
  },
  created() {
    this.visible = this.$route.path !== "/jogar";
  },
  updated() {
    this.visible = this.$route.path !== "/jogar";
  },
};
</script>

<style>
body {
  background-color: #222222;
}
.visible {
  visibility: visible;
}
.invisible {
  visibility: hidden;
}
.md-center {
  text-align: center;
}
.md-body-1,
.md-body-2 {
  margin: auto;
  width: 75%;
}
#footer {
  padding: 10px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}
#logo,
#description {
  padding: 50px 10px;
}
#description {
  padding-bottom: 150px;
}
#team,
.member {
  padding-bottom: 70px;
}
#about,
#source {
  padding-bottom: 30px;
}
.member {
  min-height: 800px;
}
#about,
#source,
.member {
  color: black;
  background-color: white;
}
#about {
  border-top: 100px solid #212121;
}
#source {
  border-top: 100px solid #9e9e9e;
}
#about > .md-title,
#source > .md-title,
#team > .md-title {
  line-height: 40px;
  padding: 30px 10px;
}
#about > .md-body-2,
#source > .md-body-2,
#team > .md-body-2,
.member > .md-body-2,
.member > img {
  padding: 15px 10px;
}
#about > .md-title,
#source > .md-title,
#team > .md-title,
.member > .md-title {
  font-weight: bold;
}
#about > .md-title > span,
#source > .md-title > span,
#team > .md-title > span {
  font-size: 24px;
  padding: 10px 5px;
}
#about > .md-title > span,
#team > .md-title > span {
  background-color: var(--md-theme-default-accent);
}
#source > .md-title > span {
  background-color: var(--md-theme-default-primary);
}
.member > .md-title {
  text-decoration: solid underline var(--md-theme-default-accent) 3px;
}
.member > .md-body-2 {
  text-align: left;
}
.ml {
  margin-left: 15px;
}

.barra-logos {
  background-color: #fff;
  padding: 10px;
  border-radius: 15px !important;
}

.botao {
    color: #fff !important;
    background-color: #000 !important;
    border-color: #000 !important;
    border-width: 3px !important; 
    border-style: solid !important;
    border-radius: 10px !important;
    text-align: center !important;
    font-size: 12px !important;
    font-weight: bold !important;
    line-height: 50% !important;
}

.msg-error {
  color: #ff0000;
  font-size: 14px;
  font-weight: bold;
}

.branco {
  color: #fff !important;
}


.md-field.md-theme-default .md-helper-text, .md-field.md-theme-default .md-count, .md-field.md-theme-default label, .md-layout {
    color: #000 !important;
}

.md-field.md-theme-default:after {
    background-color: rgba(0,0,0,0.7) !important;
}

.md-focused .md-input, .md-focused .md-textarea, .md-highlight .md-input, .md-highlight .md-textarea {
    color: #000 !important;
}

input {
  color: -internal-light-dark(black, black) !important;
}

.md-field.md-theme-default.md-focused .md-input, .md-field.md-theme-default.md-focused .md-textarea, .md-field.md-theme-default.md-has-value .md-input, .md-field.md-theme-default.md-has-value .md-textarea {
    -webkit-text-fill-color: #000 !important;
}
</style>
