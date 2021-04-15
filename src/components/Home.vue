<template>
  <div class="md-layout md-gutter md-alignment-center">
    <section id="logo" class="md-center md-layout-item md-size-100">
      <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
      <p class="md-title">Um game sobre consumo consciente!!</p>
      <router-link to="/jogar">
        <md-button class="md-raised md-accent">Jogue Agora</md-button>
      </router-link>
    </section>
    <section id="description" class="md-layout-item md-size-100">
      <p class="md-body-1">
        Venha contribuir para o desenvolvimento de modo sustentável no
        Território do Bem, em Vitória, Espírito Santo, a partir desse game que
        explora nossas referências dos bairros de Itararé, Bairro da Penha, São
        Benedito, Bonfim, Engenharia, Gurigica, Consolação, Jaburu e Floresta,
        com perguntas interessantes para conscientização do consumo na vivência
        das atividades socioecônomicas desses locais.
        <strong>Seja um Cria Consciente!!!</strong>
      </p>
    </section>
    <section id="about" class="md-layout-item md-size-100">
      <h1 class="md-center md-title">
        MAS AFINAL, O QUE É <span>CONSUMO CONSCIENTE</span>?
      </h1>
      <p class="md-body-2">
        Derivado do consumo sustentável, o consumo consciente é aquele em que
        cada escolha é feita pensando no impacto que terá no meio ambiente, na
        sociedade e até nas suas finanças. O conceito não é nada complicado: ele
        pode fazer parte do seu dia a dia e você nem vai perceber.
      </p>
      <p class="md-body-2">
        Sabe quando você deixa de comprar mais frutas no supermercado porque
        prefere consumir antes aquelas que já têm em casa? Ou quando abre mão de
        comprar por impulso uma roupa que você nem precisa? Você está consumindo
        de forma consciente, fazendo escolhas que vão ajudar a evitar o
        desperdício de comida e de dinheiro.
      </p>
      <p class="md-body-2">
        É cada vez maior o número de pessoas interessadas em mudar a sua maneira
        de consumir, como indica
        <a
          href="https://www.akatu.org.br/releases/pesquisa-akatu-2018-traca-panorama-do-consumo-consciente-no-brasil/"
          target="_blank"
          >pesquisa</a
        >
        do Instituto Akatu realizada em 2018. Segundo o estudo, muitos
        consumidores que eram indiferentes demonstraram interesse em ter mais
        consciência ao consumir
        <a
          href="https://www.bv.com.br/bv-inspira/noticias/consumo-consciente"
          target="_blank"
          >(clique e acesse a fonte de pesquisa)</a
        >.
      </p>
    </section>
    <section id="source" class="md-layout-item md-size-100">
      <h1 class="md-center md-title">
        MASSA!!! COMO FOI <span>DESENVOLVIDO O GAME</span>?
      </h1>
      <p class="md-body-2">
        O jogo foi desenvolvido em Oficina de Tecnologias Digitais. O objetivo
        foi a aprendizagem sobre os princípios e as técnicas de concepção, de
        desenvolvimento e de gestão de projetos para games.
      </p>
      <p class="md-body-2">
        Para o ambiente de programação, o game engine utilizado foi o
        <a href="https://www.nunustudio.org/" target="_blank">nunuStudio</a>, de
        código aberto, que permite o desenvolvimento de jogos que podem ser
        executados diretamente na web ou exportados como aplicativo. Tem um
        editor visual completo e suporta uma ampla gama de formatos de arquivo.
      </p>
      <p class="md-body-2">
        Para o site e as interfaces, o framework utilizado foi o
        <a href="https://vuejs.org/" target="_blank">Vue.js</a>, de código
        aberto, que permite a construção de interfaces de página única, com
        recursos avançados necessários para aplicativos complexos como
        roteamento, gerenciamento de estado e ferramentas de construção,
        oferecidos por meio de bibliotecas e pacotes de suporte mantidos
        oficialmente.
      </p>
      <p class="md-center">
        <md-button :href="source" class="md-raised">Código-fonte</md-button>
      </p>
    </section>
  </div>
</template>
<script>
export default {
  computed: {
    source() {
      return "https://github.com/ateliedeideias/crias-conscientes";
    },
  },
};
</script>
