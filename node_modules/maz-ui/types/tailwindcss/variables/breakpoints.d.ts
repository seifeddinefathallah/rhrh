export declare const screens: {
    'mob-s': string;
    'mob-m': string;
    'mob-l': string;
    'tab-s': string;
    'tab-m': string;
    'tab-l': string;
    'lap-s': string;
    'lap-m': string;
    'lap-l': string;
    'lap-xl': string;
    'lap-2xl': string;
    'lap-3xl': string;
};
export declare function getNumericScreensFromTailwind<T extends Record<string, string> | Record<string, number>>(inputScreens: T): Record<keyof T, number>;
