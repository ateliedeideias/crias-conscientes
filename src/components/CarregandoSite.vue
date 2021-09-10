<template>
  <div class="md-center">
    <md-progress-spinner class="md-accent" :md-stroke="3" md-mode="indeterminate"></md-progress-spinner><br />
    {{texto}}
  </div>
</template>

<script>
export default {
  name: 'CarregandoSite',
  props: ['texto']
}
</script>