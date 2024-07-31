declare const _default: __VLS_WithTemplateSlots<import("vue").DefineComponent<{
    noClose: {
        type: BooleanConstructor;
        default: boolean;
    };
    noPadding: {
        type: BooleanConstructor;
        default: boolean;
    };
}, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    close: (...args: any[]) => void;
    open: (...args: any[]) => void;
    "update:model-value": (...args: any[]) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<{
    noClose: {
        type: BooleanConstructor;
        default: boolean;
    };
    noPadding: {
        type: BooleanConstructor;
        default: boolean;
    };
}>> & {
    onClose?: ((...args: any[]) => any) | undefined;
    onOpen?: ((...args: any[]) => any) | undefined;
    "onUpdate:model-value"?: ((...args: any[]) => any) | undefined;
}, {
    noPadding: boolean;
    noClose: boolean;
}, {}>, {
    default?(_: {
        close: () => void;
    }): any;
}>;
export default _default;
type __VLS_WithTemplateSlots<T, S> = T & {
    new (): {
        $slots: S;
    };
};
