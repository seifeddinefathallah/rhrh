export interface UseWindowSizeOptions {
    /**
     * The window object to use
     * @default window - in browser, undefined in SSR
     */
    internalWindow?: Window | undefined;
    /**
     * Initial width of the window (useful in SSR)
     * @default Number.POSITIVE_INFINITY
     */
    initialWidth?: number;
    /**
     * Initial height of the window (useful in SSR)
     * @default Number.POSITIVE_INFINITY
     */
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
}
export declare function useWindowSize(options?: UseWindowSizeOptions): {
    width: import("vue").Ref<number>;
    height: import("vue").Ref<number>;
};
