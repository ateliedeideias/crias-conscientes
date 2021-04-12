<template>
  <div id="app">
    <main>
      <md-tabs md-sync-route>
        <md-tab id="tab-home" md-label="Sobre o jogo" to="/" exact>
          <router-view></router-view>
        </md-tab>
        <md-tab id="tab-team" md-label="A equipe" to="/team">
          <router-view></router-view>
        </md-tab>
      </md-tabs>
    </main>
    <footer class="md-bottom-bar md-theme-default md-type-fixed">
      <p class="md-caption">Realização</p>
      <a href="https://www.instagram.com/ateliedeideias.es/" target="_blank">
        <img
          alt="Ateliê de Ideias"
          src="@/assets/atelie.png"
          width="96"
          height="96"
        />
      </a>
    </footer>
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
  },
};
</script>

<style>
main {
  min-height: 800px;
}
footer {
  padding: 10px;
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}
</style>
