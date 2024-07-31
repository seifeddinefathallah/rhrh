declare const plugin: {
    install(app: import("vue").App<any>): void;
};
export * from './click-outside';
export * from './v-lazy-img';
export * from './v-zoom-img';
export * from './v-fullscreen-img';
export * from './v-lazy-img';
export * from './closable';
export * from './tooltip';
export { plugin as installDirectives };
