<template>
  <div id="app">
    <main>
      <md-tabs md-sync-route>
        <md-tab id="tab-jogo" md-label="Sobre o jogo" exact></md-tab>
        <md-tab id="tab-equipe" md-label="A equipe"></md-tab>
      </md-tabs>
    </main>
    <footer></footer>
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
</style>
