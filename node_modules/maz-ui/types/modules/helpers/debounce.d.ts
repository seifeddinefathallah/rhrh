export declare function debounce<F extends (...args: Parameters<F>) => ReturnType<F>>(fn: F, delay: number): (...args: Parameters<F>) => void;
