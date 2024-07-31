import type { Color, Size } from './types';
export type { Color, Size };
declare const _default: __VLS_WithTemplateSlots<import("vue").DefineComponent<__VLS_WithDefaults<__VLS_TypePropsToOption<{
    /** Style attribut of the component root element */
    style?: import("vue").StyleValue;
    /** Class attribut of the component root element */
    class?: any;
    /** The id of the radio */
    id?: string | undefined;
    /** @model The value of the radio */
    modelValue?: string | number | boolean | undefined;
    /** The value of the radio */
    value: string | number | boolean;
    /** The name of the radio */
    name: string;
    /** The label of the radio */
    label?: string | undefined;
    /** The color of the radio */
    color?: Color | undefined;
    /** The size of the radio */
    size?: Size | undefined;
    /** The disabled state of the radio */
    disabled?: boolean | undefined;
}>, {
    style: undefined;
    class: undefined;
    id: undefined;
    modelValue: undefined;
    label: undefined;
    color: string;
    size: string;
    disabled: boolean;
}>, {}, unknown, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {
    "update:model-value": (value: string | number | boolean) => void;
    change: (value: string | number | boolean) => void;
}, string, import("vue").PublicProps, Readonly<import("vue").ExtractPropTypes<__VLS_WithDefaults<__VLS_TypePropsToOption<{
    /** Style attribut of the component root element */
    style?: import("vue").StyleValue;
    /** Class attribut of the component root element */
    class?: any;
    /** The id of the radio */
    id?: string | undefined;
    /** @model The value of the radio */
    modelValue?: string | number | boolean | undefined;
    /** The value of the radio */
    value: string | number | boolean;
    /** The name of the radio */
    name: string;
    /** The label of the radio */
    label?: string | undefined;
    /** The color of the radio */
    color?: Color | undefined;
    /** The size of the radio */
    size?: Size | undefined;
    /** The disabled state of the radio */
    disabled?: boolean | undefined;
}>, {
    style: undefined;
    class: undefined;
    id: undefined;
    modelValue: undefined;
    label: undefined;
    color: string;
    size: string;
    disabled: boolean;
}>>> & {
    onChange?: ((value: string | number | boolean) => any) | undefined;
    "onUpdate:model-value"?: ((value: string | number | boolean) => any) | undefined;
}, {
    size: Size;
    label: string;
    style: string | false | import("vue").CSSProperties | import("vue").StyleValue[] | null;
    id: string;
    disabled: boolean;
    color: Color;
    class: any;
    modelValue: string | number | boolean;
}, {}>, {
    default?(_: {
        isSelected: boolean;
        value: string | number | boolean;
    }): any;
}>;
export default _default;
type __VLS_WithDefaults<P, D> = {
    [K in keyof Pick<P, keyof P>]: K extends keyof D ? __VLS_Prettify<P[K] & {
        default: D[K];
    }> : P[K];
};
type __VLS_Prettify<T> = {
    [K in keyof T]: T[K];
} & {};
type __VLS_WithTemplateSlots<T, S> = T & {
    new (): {
        $slots: S;
    };
};
type __VLS_NonUndefinedable<T> = T extends undefined ? never : T;
type __VLS_TypePropsToOption<T> = {
    [K in keyof T]-?: {} extends Pick<T, K> ? {
        type: import('vue').PropType<__VLS_NonUndefinedable<T[K]>>;
    } : {
        type: import('vue').PropType<T[K]>;
        required: true;
    };
};
