import { type PropType } from 'vue';
import type { Color } from './types';
export type { Color };
declare const _default: import("vue").DefineComponent<{
    /** Array of cursors values */
    modelValue: {
        type: PropType<number | number[]>;
        required: true;
        validator: (value: string) => boolean;
    };
    /** array of cursors label */
    labels: {
        type: ArrayConstructor;
        default: undefined;
    };
    /** min value of sliders */
    min: {
        type: NumberConstructor;
        default: number;
    };
    /** max value of sliders */
    max: {
        type: NumberConstructor;
        default: number;
    };
    /** height size of slider bar */
    size: {
        type: StringConstructor;
        default: undefined;
    };
    /** remove div in different colors */
    noDivider: {
        type: BooleanConstructor;
        default: boolean;
    };
    /** become a logarithmic slider (exponential) */
    log: {
        type: BooleanConstructor;
        default: boolean;
    };
    /** main slider color */
    color: {
        type: PropType<Color>;
        default: string;
    };
    /** disables cursor animation when active */
    noCursorAnim: {
        type: BooleanConstructor;
        default: boolean;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    "update:model-value": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    /** Array of cursors values */
    modelValue: {
        type: PropType<number | number[]>;
        required: true;
        validator: (value: string) => boolean;
    };
    /** array of cursors label */
    labels: {
        type: ArrayConstructor;
        default: undefined;
    };
    /** min value of sliders */
    min: {
        type: NumberConstructor;
        default: number;
    };
    /** max value of sliders */
    max: {
        type: NumberConstructor;
        default: number;
    };
    /** height size of slider bar */
    size: {
        type: StringConstructor;
        default: undefined;
    };
    /** remove div in different colors */
    noDivider: {
        type: BooleanConstructor;
        default: boolean;
    };
    /** become a logarithmic slider (exponential) */
    log: {
        type: BooleanConstructor;
        default: boolean;
    };
    /** main slider color */
    color: {
        type: PropType<Color>;
        default: string;
    };
    /** disables cursor animation when active */
    noCursorAnim: {
        type: BooleanConstructor;
        default: boolean;
    };
}>> & {
    "onUpdate:model-value"?: ((...args: any[]) => any) | undefined;
}, {
    size: string;
    color: Color;
    max: number;
    min: number;
    labels: unknown[];
    noDivider: boolean;
    log: boolean;
    noCursorAnim: boolean;
}, {}>;
export default _default;
