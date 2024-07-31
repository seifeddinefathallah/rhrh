export interface ScriptLoaderOptions {
    identifier: string;
    src: string;
    once?: boolean;
    async?: boolean;
    defer?: boolean;
}
export declare class ScriptLoader {
    private src;
    private script?;
    private once;
    private async;
    private defer;
    private identifier;
    constructor({ src, identifier, once, async, defer }: ScriptLoaderOptions);
    removeTag(tag: Element | string): void;
    load(): Promise<unknown>;
    private injectScript;
}
