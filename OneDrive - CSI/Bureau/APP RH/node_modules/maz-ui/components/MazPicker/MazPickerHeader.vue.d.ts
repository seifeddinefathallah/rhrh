import { type PropType } from 'vue';
import type { Color } from '../types';
import type { PickerValue } from './types';
import type { DateTimeFormatOptions } from './utils';
declare const _default: import("vue").DefineComponent<{
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    color: {
        type: PropType<Color>;
        required: true;
    };
    locale: {
        type: StringConstructor;
        required: true;
    };
    noShortcuts: {
        type: BooleanConstructor;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    hasDate: {
        type: BooleanConstructor;
        required: true;
    };
    hasTime: {
        type: BooleanConstructor;
        required: true;
    };
    formatterOptions: {
        type: PropType<DateTimeFormatOptions>;
        required: true;
    };
    calendarDate: {
        type: StringConstructor;
        required: true;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    color: {
        type: PropType<Color>;
        required: true;
    };
    locale: {
        type: StringConstructor;
        required: true;
    };
    noShortcuts: {
        type: BooleanConstructor;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    hasDate: {
        type: BooleanConstructor;
        required: true;
    };
    hasTime: {
        type: BooleanConstructor;
        required: true;
    };
    formatterOptions: {
        type: PropType<DateTimeFormatOptions>;
        required: true;
    };
    calendarDate: {
        type: StringConstructor;
        required: true;
    };
}>>, {
    modelValue: PickerValue;
}, {}>;
export default _default;
