import { type PropType } from 'vue';
declare const _default: import("vue").DefineComponent<{
    /** The source path of the SVG file - e.g: `/icons/home.svg` */
    src: {
        type: StringConstructor;
        default: undefined;
    };
    /** The path of the folder where the SVG files are stored - e.g: `/icons` */
    path: {
        type: StringConstructor;
        default: undefined;
    };
    /** The name of the SVG file - e.g: `home` */
    name: {
        type: StringConstructor;
        default: undefined;
    };
    /** The size of the SVG file - e.g: `1em` */
    size: {
        type: StringConstructor;
        default: undefined;
    };
    /** The title of the SVG file - e.g: `Home` */
    title: {
        type: StringConstructor;
        default: undefined;
    };
    /** The function to transform the source of the SVG file - e.g: `(svg) => svg` */
    transformSource: {
        type: PropType<(param: SVGElement) => SVGElement>;
        default: (svg: SVGElement) => SVGElement;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    loaded: (svg: SVGElement | undefined) => void;
    unloaded: () => void;
    error: (error: Error) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    /** The source path of the SVG file - e.g: `/icons/home.svg` */
    src: {
        type: StringConstructor;
        default: undefined;
    };
    /** The path of the folder where the SVG files are stored - e.g: `/icons` */
    path: {
        type: StringConstructor;
        default: undefined;
    };
    /** The name of the SVG file - e.g: `home` */
    name: {
        type: StringConstructor;
        default: undefined;
    };
    /** The size of the SVG file - e.g: `1em` */
    size: {
        type: StringConstructor;
        default: undefined;
    };
    /** The title of the SVG file - e.g: `Home` */
    title: {
        type: StringConstructor;
        default: undefined;
    };
    /** The function to transform the source of the SVG file - e.g: `(svg) => svg` */
    transformSource: {
        type: PropType<(param: SVGElement) => SVGElement>;
        default: (svg: SVGElement) => SVGElement;
    };
}>> & {
    onLoaded?: ((svg: SVGElement | undefined) => any) | undefined;
    onError?: ((error: Error) => any) | undefined;
    onUnloaded?: (() => any) | undefined;
}, {
    size: string;
    title: string;
    name: string;
    src: string;
    path: string;
    transformSource: (param: SVGElement) => SVGElement;
}, {}>;
export default _default;
