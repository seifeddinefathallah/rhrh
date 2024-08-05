import type { PropType } from 'vue';
import type { Color } from './types';
export type { Color };
declare const _default: import("vue").DefineComponent<{
    size: {
        type: StringConstructor;
        default: string;
    };
    color: {
        type: PropType<Color>;
        default: string;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    size: {
        type: StringConstructor;
        default: string;
    };
    color: {
        type: PropType<Color>;
        default: string;
    };
}>>, {
    size: string;
    color: Color;
}, {}>;
export default _default;
