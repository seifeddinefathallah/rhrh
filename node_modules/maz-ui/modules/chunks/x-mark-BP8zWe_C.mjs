import { openBlock as e, createElementBlock as t, createElementVNode as o } from "vue";
const n = {
  xmlns: "http://www.w3.org/2000/svg",
  width: "1em",
  height: "1em",
  fill: "none",
  viewBox: "0 0 24 24"
}, r = /* @__PURE__ */ o(
  "path",
  {
    stroke: "currentColor",
    "stroke-linecap": "round",
    "stroke-linejoin": "round",
    "stroke-width": "1.5",
    d: "M6 18 18 6M6 6l12 12"
  },
  null,
  -1
  /* HOISTED */
), s = [
  r
];
function c(l, i) {
  return e(), t("svg", n, [...s]);
}
const h = { render: c };
export {
  h as default,
  c as render
};
