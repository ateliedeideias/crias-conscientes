<template>
  <div class="flex-container">
    <div class="filho pergunta">
      <b><span v-html="pergunta.pergunta"></span></b><br />
    </div>

    <div class="filho container-respostas">
      <div v-for="(item, indice) in pergunta.respostas" :key="`resposta-${indice}`" v-html="item" v-on:click="responder(indice)" class="resposta">        
      </div>
    </div>
  </div>    
</template>

<style scoped>
  .flex-container {
    display: flex;
    flex-wrap: nowrap;
  }
  .flex-container > div {
    width: 50%;
  }
  .pergunta {
    background-color: #fffa92;
    padding: 10px;
    margin-right: 15px;
    border-color: #000;    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    line-height: 25px;
    overflow: auto;    
  }
  .container-respostas {
    overflow: auto;
  }
  .container-respostas > div:first-child {
    background-color: #3acf67;
  }
  .container-respostas > div:nth-child(2) {
    background-color: #f2418b;
  }
  .container-respostas > div:nth-child(3) {
    background-color: #f87821;
  }
  .resposta {
    cursor: pointer;
    padding: 10px;
    margin-bottom: 30px;
    margin-left: 15px;
    border-color: #000;    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    font-size: 17px;
    font-weight: bold;
    line-height: 20px;
  }
  .resposta:hover {
    background-color: #93d5d0;
  }  
  @media (max-height: 1024px) {
    .filho {
      max-height: 780px;
    }
  }
  @media (max-height: 768px) {
    .filho {
      max-height: 590px;
    }
  }
  @media (max-height: 540px) {
    .filho {
      max-height: 300px;
    }
  }
  @media (max-height: 375px) {
    .filho {
      max-height: 265px;
    }
  }
  @media (max-height: 320px) {
    .filho {
      max-height: 235px;
    }
  }
    @media (max-height: 280px) {
    .filho {
      max-height: 190px;
    }
  }
</style>

<script>
export default {
  name: "AcaoPergunta",
  props: ['pergunta'],
  methods: {
    responder(indice) {
      var acertou = indice === this.pergunta.correta - 1;
      this.$emit('responder', acertou);
    }
  }
}
</script>