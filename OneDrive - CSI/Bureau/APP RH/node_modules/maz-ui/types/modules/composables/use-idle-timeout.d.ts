import { IdleTimeout, type IdleTimeoutCallback, type IdleTimeoutOptions } from '../helpers/idle-timeout';
export declare function useIdleTimeout({ callback, options, }: {
    callback: IdleTimeoutCallback;
    options?: IdleTimeoutOptions;
}): IdleTimeout;
