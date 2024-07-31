import { defineComponent as n, ref as c, computed as m, provide as p, openBlock as d, createElementBlock as i, renderSlot as f } from "vue";
const v = { class: "m-tabs" }, T = /* @__PURE__ */ n({
  __name: "MazTabs",
  props: {
    modelValue: {}
  },
  emits: ["update:model-value"],
  setup(o, { emit: l }) {
    const s = o, u = l, t = c(1), a = m({
      get: () => s.modelValue ?? t.value,
      set: (e) => {
        t.value = e, u("update:model-value", e);
      }
    });
    function r(e) {
      return a.value = e, e;
    }
    return p("maz-tabs", {
      currentTab: a,
      updateCurrentTab: r
    }), (e, _) => (d(), i("div", v, [
      f(e.$slots, "default")
    ]));
  }
});
export {
  T as default
};
