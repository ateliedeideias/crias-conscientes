<template>
  <div class="videoframe">
    <youtube video-id="i_UEIX9ENUM" height="600" width="800" :player-vars="{ autoplay: 1 }" @ended="fimVideo()"></youtube>
  </div>
</template>

<style>
.videoframe {
  height: calc(100vh * 0.68);
  width: calc(100vw * 0.68);
  text-align: center;
  align-content: center;
  align-items: center;
}

iframe {
  height: 100% !important;
  width: 100% !important;
}
</style>

<script>
export default {
  name: 'Trailer',
  methods: {
    fimVideo() {
      this.$emit('fimVideo');
    }
  }
}
</script>