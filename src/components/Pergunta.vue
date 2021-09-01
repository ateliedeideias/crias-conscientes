<template>
    <div>
        <acao-pergunta v-if="exibirPergunta" :pergunta="perguntaAtual" @responder="acaoResposta" />

        <resultado-perguntas 
            v-if="!exibirPergunta"
            :textoResultado="textoResultado"
            :exibirUltimoResultado="exibirUltimoResultado"
            :totalAcertos="totalAcertos"
            :totalPerguntas="perguntas.length"
            @continuar="continuar" />
    </div>
</template>

<style scoped>
</style>

<script>
import AcaoPergunta from './AcaoPergunta.vue';
import ResultadoPerguntas from './ResultadoPerguntas.vue';

export default {
    components: {AcaoPergunta, ResultadoPerguntas},
    name: 'Pergunta',
    props: ['perguntas'],
    data() {
        return {
            numeroPergunta: 1,
            totalAcertos: 0,
            exibirPergunta: true,
            textoResultado: "",
        };
    },
    computed: {
        totalPerguntas: function() {
            return this.perguntas.length;
        },
        perguntaAtual: function() {
            if (this.numeroPergunta > this.totalPerguntas) return null;
            return this.perguntas[this.numeroPergunta - 1];
        },
        exibirUltimoResultado: function() {
            return this.numeroPergunta == this.perguntas.length;
        }
    },
    methods: {
        acaoResposta(acertou) {
            if (acertou) {
                this.totalAcertos++;
                this.textoResultado = this.perguntaAtual.textoCerto ??   "Parabéns, continue praticando e se torne um cria consciente.";
            } else {
                this.textoResultado = this.perguntaAtual.textoErrado ??   "Puxa... infelizmente você errou essa, mas não desista...";
            }
            this.exibirPergunta = false;
        },
        continuar() {
            if (this.exibirUltimoResultado){
                this.$emit("fimPerguntas", this.totalAcertos);
                return;
            }

            this.numeroPergunta++;
            this.exibirPergunta = true;
        }
    }
}
</script>