import type { App } from 'vue';
import type { ToasterOptions } from './types';
export interface LocalToasterOptions extends ToasterOptions {
    type: 'success' | 'info' | 'warning' | 'danger' | 'theme';
}
export declare class ToasterHandler {
    private readonly app;
    private readonly globalOptions?;
    constructor(app: App, globalOptions?: ToasterOptions | undefined);
    private show;
    private getLocalOptions;
    message(message: string, options?: ToasterOptions): {
        destroy: () => void;
        close: () => any;
    };
    success(message: string, options?: ToasterOptions): {
        destroy: () => void;
        close: () => any;
    };
    error(message: string, options?: ToasterOptions): {
        destroy: () => void;
        close: () => any;
    };
    info(message: string, options?: ToasterOptions): {
        destroy: () => void;
        close: () => any;
    };
    warning(message: string, options?: ToasterOptions): {
        destroy: () => void;
        close: () => any;
    };
}
