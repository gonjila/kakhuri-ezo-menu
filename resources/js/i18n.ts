import {createI18n} from "vue-i18n";

const i18nConfig = createI18n({
    locale: import.meta.env.VITE_APP_LOCALE,
    fallbackLocale: import.meta.env.VITE_APP_FALLBACK_LOCALE,
    availableLocales:['ka', 'en'],
    messages: {
        en: {
            message: {
                hello: 'hello world'
            },
            auth: {
                login: 'login'
            },
        },
        ka: {
            message: {
                hello: 'გამარჯობა სამყაროვ'
            },
            auth: {
                login: 'შესვლა'
            },
        }

    }
})

export default i18nConfig;
