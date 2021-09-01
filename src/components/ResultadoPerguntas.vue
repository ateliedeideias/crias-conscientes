<template>
    <div class="botton-resposta">
        <b>{{textoResultado}}</b><br /><br />
        <div v-if="exibirUltimoResultado">
            <span v-if="porcentagemAcertos === 100">Uhuu, Você acertou TODAS, Parabéns!</span>
            <span v-else-if="porcentagemAcertos === 50">Você acertou a metade das questões.</span>
            <span v-else-if="porcentagemAcertos === 0">Que pena, você não acertou nenhuma questão.</span>
            <span v-else-if="porcentagemAcertos > 50">Você resolveu a maioria das questões!, continue progredindo ...</span>            
            <span v-else-if="porcentagemAcertos < 50">Hum... Você acertou menos da metade das questões.</span>            
            <br /><br />
        </div>
        <md-button class="botton-resposta-filho" v-on:click="continuar()">{{textoBotao}}</md-button>
    </div>
</template>

<script>
export default {
    name:"ResultadoPerguntas",
    props: ['textoResultado', 'exibirUltimoResultado', 'totalAcertos', 'totalPerguntas'],
    computed: {
        porcentagemAcertos: function() {
            return (100 * this.totalAcertos) / this.totalPerguntas;
        },
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

<style scoped>
.botton-resposta {
    color: black;
    background-color: #00d0c2;
    padding: 10px;
    border-color: #000;    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    text-align: center;
    font-size: 15px;
    font-weight: bold;
    line-height: 25px;
    overflow: auto;
}
.botton-resposta-filho {
    color: #fff;
    background-color: #000000;
    border-color: rgb(0, 0, 0);    
    border-width: 3px; 
    border-bottom-width: 6px;   
    border-style: solid;
    border-radius: 10px;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    line-height: 50%;
    overflow: auto;
}
</style>