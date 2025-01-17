import {createI18n} from "vue-i18n";

import en from '@/Lang/en';
import ka from '@/Lang/ka';

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
