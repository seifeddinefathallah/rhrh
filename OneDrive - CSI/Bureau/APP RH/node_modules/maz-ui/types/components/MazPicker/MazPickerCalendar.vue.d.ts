import { type PropType } from 'vue';
import type { Color } from '../types';
import type { PickerShortcut, PickerValue } from './types';
declare const _default: import("vue").DefineComponent<{
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    calendarDate: {
        type: StringConstructor;
        required: true;
    };
    color: {
        type: PropType<Color>;
        required: true;
    };
    locale: {
        type: StringConstructor;
        required: true;
    };
    firstDayOfWeek: {
        type: NumberConstructor;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    minDate: {
        type: StringConstructor;
        default: undefined;
    };
    maxDate: {
        type: StringConstructor;
        default: undefined;
    };
    disabledWeekly: {
        type: PropType<number[]>;
        required: true;
    };
    disabledDates: {
        type: PropType<string[]>;
        required: true;
    };
    shortcuts: {
        type: PropType<PickerShortcut[]>;
        required: true;
    };
    noShortcuts: {
        type: BooleanConstructor;
        required: true;
    };
    hasTime: {
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
    "update:calendar-date": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    modelValue: {
        type: PropType<PickerValue>;
        default: undefined;
    };
    calendarDate: {
        type: StringConstructor;
        required: true;
    };
    color: {
        type: PropType<Color>;
        required: true;
    };
    locale: {
        type: StringConstructor;
        required: true;
    };
    firstDayOfWeek: {
        type: NumberConstructor;
        required: true;
    };
    double: {
        type: BooleanConstructor;
        required: true;
    };
    minDate: {
        type: StringConstructor;
        default: undefined;
    };
    maxDate: {
        type: StringConstructor;
        default: undefined;
    };
    disabledWeekly: {
        type: PropType<number[]>;
        required: true;
    };
    disabledDates: {
        type: PropType<string[]>;
        required: true;
    };
    shortcuts: {
        type: PropType<PickerShortcut[]>;
        required: true;
    };
    noShortcuts: {
        type: BooleanConstructor;
        required: true;
    };
    hasTime: {
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
    "onUpdate:calendar-date"?: ((...args: any[]) => any) | undefined;
}, {
    modelValue: PickerValue;
    minDate: string;
    maxDate: string;
    shortcut: string;
}, {}>;
export default _default;
