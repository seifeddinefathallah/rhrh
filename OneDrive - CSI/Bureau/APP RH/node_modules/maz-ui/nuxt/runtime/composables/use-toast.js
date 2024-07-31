import { useNuxtApp } from "#imports";
export function useToast() {
  const { $toast } = useNuxtApp();
  return $toast;
}
