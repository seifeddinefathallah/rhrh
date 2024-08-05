import * as _nuxt_schema from '@nuxt/schema';
import { AosOptions, ToasterOptions, ThemeHandlerOptions, vLazyImgOptions, vTooltipOptions } from 'maz-ui';

interface MazUiNuxtOptions {
    /**
     * Enable auto-import of main css file
     * @default true
     */
    injectCss?: boolean;
    /**
     * Install aos plugin and enable auto-import of useAos composable
     * @default false
     */
    injectAos?: boolean | (Omit<AosOptions, 'router'> & {
        /**
         * Auto inject aos CSS file
         * @default true
         */
        injectCss?: boolean;
        /**
         * Set `true` to re-run animations on page change
         * @default false
         */
        router?: boolean;
    });
    /**
     * Install toaster plugin and enable auto-import of useToast composable
     * @default false
     */
    injectUseToast?: boolean | ToasterOptions;
    /**
     * Install wait plugin and enable auto-import of useWait composable
     * @default false
     */
    injectUseWait?: boolean;
    /**
     * Enable auto-import of useSwipe composable
     * @default false
     */
    injectUseSwiper?: boolean;
    /**
     * Enable auto-import of useThemeHandler composable
     * @default false
     */
    injectUseThemeHandler?: boolean | ThemeHandlerOptions;
    /**
     * Enable auto-import of useIdleTimeout composable
     * @default false
     */
    injectUseIdleTimeout?: boolean;
    /**
     * Enable auto-import of useUserVisibility composable
     * @default false
     */
    injectUseUserVisibility?: boolean;
    /**
     * Enable auto-import of useTimer composable
     * @default false
     */
    injectUseTimer?: boolean;
    /**
     * Enable auto-import of useWindowSize composable
     * @default false
     */
    injectUseWindowSize?: boolean;
    /**
     * Enable auto-import of useBreakpoints composable
     * @default false
     */
    injectUseBreakpoints?: boolean;
    /**
     * Enable auto-import of useReadingTime composable
     * @default false
     */
    injectUseReadingTime?: boolean;
    /**
     * Enable auto-import of useStringMatching composable
     * @default false
     */
    injectUseStringMatching?: boolean;
    /**
     * Globally install of v-zoom-img directive
     * @default false
     */
    installVZoomImg?: boolean;
    /**
     * Globally install of v-click-outside directive
     * @default false
     */
    installVClickOutside?: boolean;
    /**
     * Globally install of v-fullscreen-img directive
     * @default false
     */
    installVFullscreenImg?: boolean;
    /**
     * Globally install of v-lazy-img directive
     * @default false
     */
    installVLazyImg?: boolean | vLazyImgOptions;
    /**
     * Globally install of v-tooltip directive
     * @default false
     */
    installVTooltip?: boolean | vTooltipOptions;
    /**
     * Enable auto-import of all components
     * @default true
     */
    injectComponents?: boolean;
    /**
     * Default path to public svg icons folder for `<MazIcon />` component
     * @default undefined
     */
    defaultMazIconPath?: string;
    /**
     * Enable Nuxt Devtools integration
     * @default true
     */
    devtools?: boolean;
}
declare module '@nuxt/schema' {
    interface NuxtConfig {
        mazUi?: MazUiNuxtOptions;
    }
    interface NuxtOptions {
        mazUi?: MazUiNuxtOptions;
    }
    interface PublicRuntimeConfig {
        mazUi: MazUiNuxtOptions;
    }
}
declare const _default: _nuxt_schema.NuxtModule<MazUiNuxtOptions>;

export { type MazUiNuxtOptions, _default as default };
