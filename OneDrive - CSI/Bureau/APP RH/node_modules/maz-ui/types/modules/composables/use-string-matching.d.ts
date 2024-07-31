import { type Ref } from 'vue';
export declare function useStringMatching(string1: string | Ref<string>, string2: string | Ref<string>, threshold?: number | Ref<number>): {
    isMatching: import("vue").ComputedRef<boolean>;
    score: import("vue").ComputedRef<number>;
};
