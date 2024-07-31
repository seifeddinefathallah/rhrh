import type { UserVisibilyCallback, UserVisibilyOptions } from './types';
export declare class UserVisibility {
    private readonly callback;
    private eventHandlerFunction;
    private event;
    private timeoutHandler?;
    private options;
    private readonly defaultOptions;
    private isVisible;
    constructor(callback: UserVisibilyCallback, options?: UserVisibilyOptions);
    start(): void;
    private emitCallback;
    private eventHandler;
    private clearTimeout;
    private initTimeout;
    private addEventListener;
    private removeEventListener;
    destroy(): void;
}
