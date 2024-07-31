import { type PropType } from 'vue';
import type { Color } from '../types';
declare const _default: import("vue").DefineComponent<{
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
    double: {
        type: BooleanConstructor;
        required: true;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    close: (...args: any[]) => void;
    "update:calendar-date": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
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
    double: {
        type: BooleanConstructor;
        required: true;
    };
}>> & {
    onClose?: ((...args: any[]) => any) | undefined;
    "onUpdate:calendar-date"?: ((...args: any[]) => any) | undefined;
}, {}, {}>;
export default _default;
