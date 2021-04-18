<template>
    <div class="botton-resposta">
        <b>{{textoResultado}}</b><br /><br />
        <div v-if="exibirUltimoResultado">
            <span v-if="totalAcertos === 3">Uhuu, Você acertou TODAS, Parabéns!</span>
            <span v-if="totalAcertos === 2">Você resolveu duas questões!, continue progredindo ...</span>
            <span v-if="totalAcertos === 1">Humm, Você acertou só uma questão.</span>
            <span v-if="totalAcertos === 0">Que pana, você não acertou nenhuma questão.</span>
            <br /><br />
        </div>
        <md-button class="botton-resposta-filho" v-on:click="continuar()">{{textoBotao}}</md-button>
    </div>
</template>

<script>
export default {
    name:"ResultadoPerguntas",
    props: ['textoResultado', 'exibirUltimoResultado', 'totalAcertos'],
    computed: {
        textoBotao: function(){
            return this.exibirUltimoResultado ? "Retornar ao jogo" : "Próxima Pergunta";
        }
    },
    methods:{
        continuar() {
            this.$emit('continuar');
        }
    }
}
</script>

<style>
.botton-resposta {
    background-color: darkcyan;
    padding: 10px;
    border-color: #000;    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    text-align: center;
    text-color: black;
    font-size: 15px;
    font-weight: bold;
    line-height: 25px;
    overflow: auto;
}
.botton-resposta-filho {
    background-color: darkcyan;
    padding: 15px;
    border-color: #000;    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    text-align: center;
    text-color: black;
    font-size: 15px;
    font-weight: bold;
    line-height: 25px;
    overflow: auto;
}

</style>