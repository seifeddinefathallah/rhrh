import { ToasterHandler } from 'maz-ui';
declare const _default: any;
export default _default;
declare module '#app' {
    interface NuxtApp {
        $toast: ToasterHandler;
    }
}
