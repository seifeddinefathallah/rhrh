import type { DirectiveBinding } from 'vue';
export interface vFullscreenImgOptions {
    disabled?: boolean;
    scaleOnHover?: boolean;
    blurOnHover?: boolean;
    zoom?: boolean;
    offset?: number;
    animation?: {
        duration?: number;
        easing?: string;
    };
}
interface vFullscreenImgBindingOptions extends vFullscreenImgOptions {
    src: string;
    alt?: string | null;
}
export type vFullscreenImgBindingValue = string | vFullscreenImgBindingOptions | undefined;
export type vFullscreenImgBinding = DirectiveBinding<vFullscreenImgBindingValue>;
export declare class FullscreenImgHandler {
    private options;
    private defaultOptions;
    private mouseEnterListener;
    private mouseLeaveListener;
    private renderPreviewListener;
    private buildOptions;
    get allInstances(): HTMLElement[];
    private getImgSrc;
    private getImgAlt;
    create(el: HTMLElement, binding: vFullscreenImgBinding): void;
    update(el: HTMLElement, binding: vFullscreenImgBinding): void;
    remove(el: HTMLElement): void;
    private renderPreview;
    private mouseLeave;
    private mouseEnter;
}
export {};
