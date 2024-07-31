import { type vLazyImgBindingValue } from './lazy-img.handler';
declare const directive: {
    created(el: HTMLElement, binding: import("vue").DirectiveBinding<vLazyImgBindingValue>): void;
    updated(el: HTMLElement, binding: import("vue").DirectiveBinding<vLazyImgBindingValue>): void;
    unmounted(el: HTMLElement, binding: import("vue").DirectiveBinding<vLazyImgBindingValue>): void;
};
export { directive as vLazyImg };
