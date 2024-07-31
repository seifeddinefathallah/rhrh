import { type PropType } from 'vue';
import type { Color } from '../types';
import type { PickerShortcut, PickerValue } from './types';
declare const _default: import("vue").DefineComponent<{
    color: {
        type: PropType<Color>;
        required: true;
    };
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    shortcuts: {
        type: PropType<PickerShortcut[]>;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    shortcut: {
        type: StringConstructor;
        default: undefined;
    };
    disabled: {
        type: BooleanConstructor;
        required: true;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    "update:model-value": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    color: {
        type: PropType<Color>;
        required: true;
    };
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    shortcuts: {
        type: PropType<PickerShortcut[]>;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    shortcut: {
        type: StringConstructor;
        default: undefined;
    };
    disabled: {
        type: BooleanConstructor;
        required: true;
    };
}>> & {
    "onUpdate:model-value"?: ((...args: any[]) => any) | undefined;
}, {
    modelValue: PickerValue;
    shortcut: string;
}, {}>;
export default _default;
