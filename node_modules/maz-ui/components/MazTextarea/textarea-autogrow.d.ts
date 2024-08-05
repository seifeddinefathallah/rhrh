export declare class TextareaAutogrow {
    private element;
    constructor(element: HTMLTextAreaElement);
    private connect;
    disconnect(): void;
    private onFocus;
    private onResize;
    private autogrow;
}
