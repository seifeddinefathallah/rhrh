declare const plugin: {
    install(app: import("vue").App<any>): void;
};
export { plugin as vFullscreenImgInstall };
export { vFullscreenImg } from './fullscreen-img.directive';
export type { vFullscreenImgBindingValue, vFullscreenImgOptions } from './fullscreen-img.handler';
