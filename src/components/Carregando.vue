<template>
  <div class="container">
    <md-progress-bar md-mode="indeterminate"></md-progress-bar>
    {{texto}}
  </div>
</template>

<style lang="css" scoped>
.container {
  color:#000000;
  background-color: #ff6600;
  padding: 10px;
  margin-right: 0px;
  border-color: #000;    
  border-width: 3px; 
  border-bottom-width: 6px;   
  border-style: solid;
  border-radius: 10px;
  text-align: center;
  text-decoration-color: #ff0000;
  font-size: 20px;
  font-weight: bold;
  line-height: 25px;
  overflow: auto;    
}
</style>

<script>
export default {
  name: 'Carregando',
  props: ['texto']
}
</script>