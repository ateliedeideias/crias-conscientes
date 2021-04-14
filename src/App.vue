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
.md-center {
  text-align: center;
}
.md-body-1,
.md-body-2 {
  margin: auto;
  width: 75%;
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
</style>
