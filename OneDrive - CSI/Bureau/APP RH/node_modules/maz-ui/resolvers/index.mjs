function t(e) {
  return e.replaceAll(/-(\w)/g, (i, r) => r ? r.toUpperCase() : "");
}
function n(e) {
  return e.charAt(0).toUpperCase() + e.slice(1);
}
function o(e) {
  return n(t(e));
}
function u() {
  return {
    type: "component",
    resolve: (e) => {
      if (/^(Maz[A-Z])/.test(e))
        return { from: `maz-ui/components/${e}` };
      if (/^(maz-[a-z])/.test(e))
        return { from: `maz-ui/components/${o(e)}` };
    }
  };
}
function s() {
  return {
    type: "directive",
    resolve: (e) => ({ from: "maz-ui", as: `v${e}`, name: `v${e}` })
  };
}
export {
  s as UnpluginDirectivesResolver,
  u as UnpluginVueComponentsResolver
};
