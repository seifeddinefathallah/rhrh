declare const _default: import("vue").DefineComponent<{
    calendarDate: {
        type: StringConstructor;
        default: undefined;
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
    next: (...args: any[]) => void;
    previous: (...args: any[]) => void;
    "open-month-switcher": (...args: any[]) => void;
    "open-year-switcher": (...args: any[]) => void;
    "update:calendar-date": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    calendarDate: {
        type: StringConstructor;
        default: undefined;
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
    onNext?: ((...args: any[]) => any) | undefined;
    onPrevious?: ((...args: any[]) => any) | undefined;
    "onOpen-month-switcher"?: ((...args: any[]) => any) | undefined;
    "onOpen-year-switcher"?: ((...args: any[]) => any) | undefined;
    "onUpdate:calendar-date"?: ((...args: any[]) => any) | undefined;
}, {
    calendarDate: string;
}, {}>;
export default _default;
