import {createI18n} from "vue-i18n";

import en from './lang/en';
import ka from './lang/ka';

const i18nConfig = createI18n({
    locale: 'ka',
    fallbackLocale: 'ka',
    availableLocales:['ka', 'en'],
    messages: {
        en,
        ka
    }
})

export default i18nConfig;
