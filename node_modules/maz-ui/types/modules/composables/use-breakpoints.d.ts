import { type UseWindowSizeOptions } from './use-window-size';
export interface UseBreakpointsOptions extends UseWindowSizeOptions {
    initialWidth?: number;
    initialHeight?: number;
    /**
     * Listen to window `orientationchange` event
     *
     * @default true
     */
    listenOrientation?: boolean;
    /**
     * Whether the scrollbar should be included in the width and height
     * @default true
     */
    includeScrollbar?: boolean;
    /**
     * List of breakpoints in format `{ [key: string]: string }`  (e.g. `{ 'sm': '640px', 'md': '768px' }`)
     */
    breakpoints: Record<string, string> | Record<string, number>;
    /**
     * Is the breakpoint when the screen is considered not medium (tablet - e.g. `md`)
     * @default 'md'
     */
    mediumBreakPoint?: string;
    /**
     * Is the breakpoint when the screen is considered not medium (laptop - e.g. `lg`)
     * @default 'lg'
     */
    largeBreakPoint?: string;
}
export declare function useBreakpoints({ initialWidth, initialHeight, includeScrollbar, internalWindow, listenOrientation, breakpoints, mediumBreakPoint, largeBreakPoint, }: UseBreakpointsOptions): {
    width: import("vue").Ref<number>;
    numericBreakpoints: Record<string, number>;
    isSmallScreen: import("vue").ComputedRef<boolean>;
    isLargeScreen: import("vue").ComputedRef<boolean>;
    isMediumScreen: import("vue").ComputedRef<boolean>;
    breakpoints: Record<string, string> | Record<string, number>;
};
