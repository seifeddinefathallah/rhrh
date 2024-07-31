import { type DirectiveBinding } from 'vue';
type vClickOutsideBindingValue = (...args: any[]) => any;
type vClickOutsideDirectiveBinding = DirectiveBinding<vClickOutsideBindingValue>;
declare function onMounted(el: HTMLElement, binding: vClickOutsideDirectiveBinding): Promise<void>;
declare function onUnmounted(el: HTMLElement): void;
declare function onUpdated(el: HTMLElement, binding: vClickOutsideDirectiveBinding): void;
declare const directive: {
    mounted: typeof onMounted;
    updated: typeof onUpdated;
    unmounted: typeof onUnmounted;
};
declare const plugin: {
    install: (app: import("vue").App<any>) => void;
};
export { directive as vClickOutside, plugin as vClickOutsideInstall, vClickOutsideBindingValue };
