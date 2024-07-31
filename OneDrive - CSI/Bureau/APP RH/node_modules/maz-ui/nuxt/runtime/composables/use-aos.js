import { useNuxtApp } from "#imports";
export function useAos() {
  const { $aos } = useNuxtApp();
  return $aos;
}
