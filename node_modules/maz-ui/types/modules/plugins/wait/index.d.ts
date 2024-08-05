import { type App } from 'vue';
import { type LoaderId } from './utils';
export declare class WaitHandler {
    private _loaders;
    get loaders(): import("vue").ComputedRef<unknown[]>;
    stop(loaderId?: LoaderId): void;
    start(loaderId?: LoaderId): () => void;
    get anyLoading(): import("vue").ComputedRef<boolean>;
    isLoading(loaderId?: LoaderId): boolean;
}
export declare const instance: WaitHandler;
export declare const plugin: {
    install: (app: App) => void;
};
