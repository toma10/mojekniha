import VueI18n from 'vue-i18n'
import messages from './lang'

export default (Vue) => {
  Vue.use(VueI18n)

  const i18n = new VueI18n({
    locale: 'cs',
    messages,
  })

  const TranslatePlugin = {
    install(Vue) {
      Vue.prototype.__ = function(...params) {
        return this.$t(...params)
      }
    },
  }

  Vue.use(TranslatePlugin)

  return i18n
}

