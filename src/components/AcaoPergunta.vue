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
  color:#000000;
  background-color: #00d0c2;
  padding: 10px;
  margin-right: 15px;
  border-color: #000;    
  border-width: 3px; 
  border-bottom-width: 6px;   
  border-style: solid outset;
  border-radius: 10px;
  text-align: center;
  text-decoration-color: darkcyan;
  font-size: 20px;
  font-weight: bold;
  line-height: 25px;
  overflow: auto;    
}
.container-respostas {
  overflow: auto;
}
.container-respostas > div:first-child {
  color: #000000;
  background-color: #3acf67;
}
.container-respostas > div:nth-child(2) {
  color: #000000;
  background-color: #3acf67;
}
.container-respostas > div:nth-child(3) {
  color: #000000;
  background-color: #3acf67;
}
.resposta {
  color:darkgreen;
  cursor: pointer;
  padding: 10px;
  margin-bottom: 30px;
  margin-left: 15px;
  border-color: rgb(0, 0, 0);    
  border-width: 3px; 
  border-bottom-width: 6px;   
  border-style: solid;
  border-radius: 10px;
  font-size: 17px;
  font-weight: bold;
  line-height: 20px;
}
.resposta:hover {
  background-color: hsl(0, 0%, 0%);
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