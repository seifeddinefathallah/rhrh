import type { DirectiveBinding } from 'vue';
export interface vZoomImgOptions {
    disabled?: boolean;
    scale?: boolean;
    blur?: boolean;
}
interface vZoomImgBindingOptions extends vZoomImgOptions {
    src: string;
    alt?: string;
}
export type vZoomImgBindingValue = string | vZoomImgBindingOptions;
export type vZoomImgBinding = DirectiveBinding<vZoomImgBindingValue>;
export declare class VueZoomImg {
    private options;
    private loader;
    private wrapper;
    private img;
    private keydownHandler;
    private onImgLoadedCallback;
    private buttonsAdded;
    private defaultOptions;
    private mouseEnterListener;
    private mouseLeaveListener;
    private renderPreviewListener;
    constructor(binding: vZoomImgBinding);
    private buildOptions;
    get allInstances(): HTMLElement[];
    create(el: HTMLElement): void;
    update(binding: vZoomImgBinding): void;
    remove(el: HTMLElement): void;
    private renderPreview;
    private onImgLoaded;
    private getLoader;
    private mouseLeave;
    private mouseEnter;
    private keydownLister;
    private getButton;
    private closePreview;
    private getNewInstanceIndex;
    private nextPreviousImage;
    private useNextInstance;
    private addStyle;
    private keyboardEventHandler;
    private imgEventHandler;
}
export {};
