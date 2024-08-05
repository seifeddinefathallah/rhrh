import { UserVisibility, type UserVisibilyCallback, type UserVisibilyOptions } from '../helpers/user-visibility';
export declare function useUserVisibility({ callback, options, }: {
    callback: UserVisibilyCallback;
    options?: UserVisibilyOptions;
}): UserVisibility;
