module.exports = {
 chainWebpack: config => {
  config.module.rule('nsp')
   .test(/\.nsp$/)
   .use('file-loader').loader('file-loader')
  config.module.rule('njs')
   .test(/\.njs$/)
   .use('file-loader').loader('file-loader')
 }
}