<template>
  <div class="md-layout md-alignment-center">
    <section id="logo" class="md-center md-layout-item md-size-100">
      <img alt="Crias Conscientes" src="@/assets/logo.png" width="256" />
      <p class="md-title branco">Um game sobre consumo consciente!!</p>
      <router-link to="/jogar">
        <md-button class="md-raised md-accent">Jogue Agora</md-button>
      </router-link>
    </section>

    <section id="description" class="md-layout-item md-size-100">
      <p class="md-body-1 branco">
        <b>Seja um Cria Consciente!!!</b> A partir desse game você terá a oportunidade de explorar as
        referências dos bairros Itararé, Bairro da Penha, São Benedito, Bonfim, Engenharia, Gurigica,
        Consolação, Jaburu e Floresta, que compõem o Território do Bem. Respondendo às perguntas
        de forma lúdica sobre consumo consciente, você nos ajudará a vivenciar as atividades
        socioeconômicas do nosso Território com um outro olhar.
      </p>
    </section>

    <section id="about" class="md-layout-item md-size-100">
      <h1 class="md-center md-title">
        MAS AFINAL, O QUE É SER UM <span>CONSUMIDOR CONSCIENTE</span>?
      </h1>
      <p class="md-body-2">
        Quando você compra um produto, procura saber sua origem? Você pensa se precisa 
        realmente daquele produto? Ou sua compra acontece de modo impulsivo e automático? 
        E para onde vão as embalagens desse produto quando você as descartar? Se essas reflexões 
        ficam martelando na sua cabeça antes de consumir um produto, e te fazem mudar de atitude, 
        você é um <b>Consumidor Consciente</b>.
      </p>
      <p class="md-body-2">
        Nossos hábitos de consumo são ferramentas de transformação da sociedade, da economia e também 
        afetam diretamente o meio ambiente, já que a produção de bens utiliza os recursos do planeta.  
      </p>
      <p class="md-body-2">
        Consumir de maneira Consciente contribui com a preservação de recursos naturais e aumenta 
        a qualidade de vida onde moramos. Evitar desperdícios, reaproveitando ao máximo os produtos e alimentos, é uma ótima sacada!
      </p>
      <p class="md-body-2">
        Mudando hábitos, como: pensar bem toda vez que você adquirir um produto novo. 
        Separar adequadamente o seu lixo: o que pode ser reciclado ou reaproveitado vai 
        para a coleta seletiva ou é doado diretamente para um catador. E o úmido, aquilo 
        que não pode ser reutilizado ou reaproveitado, que está sujo, vai para o lixo 
        comum em compartimentos adequados.
      </p>
      <p class="md-body-2">
        O <b>Crias Conscientes</b> vem lhe ajudar a refletir e, de pouco a pouco, mudar de costumes. 
        Nosso planeta pede socorro, e a gente, junto com vocês temos o poder de mudar essa realidade. 
        Acompanhe mais sobre Consumo Consciente jogando o <b>Crias</b> e acessando uma das páginas que nos inspira 
        <a href="https://www.instagram.com/catadoreseducadores/" target="_blank">@catadoreseducadores</a>.  
      </p>
    </section>

    <section id="source" class="md-layout-item md-size-100">
      <h1 class="md-center md-title">
        MASSA! COMO FOI <span>DESENVOLVIDO O GAME</span>?
      </h1>
      <p class="md-body-2">
        A criação do Jogo “Crias Conscientes” é um dos produtos da atividade prática das formações,
        oferecidas pelo Projeto Economia do Bem, realizado pela Associação Ateliê de Ideias, em
        parceria com a Prefeitura de Vitória, através da SEMCID/Fundo Municipal de Proteção e
        Defesa do Consumidor/PROCON/Gerência de Qualificação do Trabalhador.
      </p>
      <p class="md-body-2">
        Usando a metodologia do aprender fazendo, os jovens criadores participam de um Ciclo de
        Formação em Tecnologias Digitais, desde outubro de 2020, com 210 horas de aulas nas áreas
        de lógica de programação, designer e de desenvolvimento e gestão de projetos para games.
        Na criação, eles/elas, que são moradores/as do Território do Bem, pensaram em todo o
        conceito, cenários e personagens, inspirados em referências locais.
      </p>
      <p class="md-body-2">
        O resultado esperado foi atingido, os jovens criadores entenderam que o consumo é um ato
        político e com esse jogo eles pretendem sensibilizar as pessoas sobre Consumo Consciente e
        Relações de Consumo.
      </p>
      <p class="md-body-2">
        Para o ambiente de programação, o game engine utilizado foi o 
        <a href="https://www.nunustudio.org/" target="_blank">nunuStudio</a> , de código
        aberto, que permite o desenvolvimento de jogos que podem ser executados diretamente na
        web ou exportados como aplicativo. Tem um editor visual completo e suporta uma ampla
        gama de formatos de arquivo.
      </p>
      <p class="md-body-2">
        Para o site e as interfaces, o framework utilizado foi o 
        <a href="https://vuejs.org/" target="_blank">Vue.js</a>, de código 
        aberto, que permite a construção de interfaces de página única, com recursos avançados, 
        necessários para aplicativos complexos como roteamento, gerenciamento de estado e ferramentas de
        construção, oferecidos por meio de bibliotecas e pacotes de suporte mantidos oficialmente.
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