import { useNuxtApp } from "#imports";
export function useWait() {
  const { $wait } = useNuxtApp();
  return $wait;
}
