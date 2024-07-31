import { type SwipeOptions } from '../helpers/swipe-handler';
export declare function useSwipe(options: Omit<SwipeOptions, 'onValuesChanged'>): {
    xDiff: import("vue").Ref<number | undefined>;
    yDiff: import("vue").Ref<number | undefined>;
    xStart: import("vue").Ref<number | undefined>;
    xEnd: import("vue").Ref<number | undefined>;
    yStart: import("vue").Ref<number | undefined>;
    yEnd: import("vue").Ref<number | undefined>;
    start: () => void;
    stop: () => void;
};
